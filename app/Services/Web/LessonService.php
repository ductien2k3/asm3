<?php

namespace App\Services\Web;

use App\Models\Lesson;
use App\Repositories\Contracts\LessonRepository;
use App\Services\Contracts\LessonServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonService implements LessonServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function getAll()
    {
        $userId = Auth::id();
        $lessons = Lesson::whereHas('course', function ($query) use ($userId) {
            $query->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        })->with('course')
            ->orderBy('updated_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->withQueryString();

        return $lessons;
    }
    public function create($data)
    {
    }
    public function store($data)
    {
        $videoUrl = null;
        $videoFile = null;

        if ($data->video_type === 'url' && $data->has('video_url')) {
            $videoUrl = $data->input('video_url');
        } elseif ($data->video_type === 'file' && $data->hasFile('video_file')) {
            $file = $data->file('video_file');
            $videoFile = $this->saveVideo($file, 'public/videos/lesson');
            $videoUrl = $videoFile['link'];
        }

        $params = [
            'course_id' => $data->input('course_id'),
            'title' => $data->input('title'),
            'video_url' => $videoUrl,
            'content' => $data->input('content'),
        ];

        return $this->lessonRepository->create($params);
    }


    public function edit($id)
    {
        return $this->lessonRepository->find($id);
    }

    public function update($data, $id)
    {
        $lesson = $this->lessonRepository->find($id);
        $videoUrl = $lesson->video_url;
        $videoFile = null;

        if ($data->video_type === 'url' && $data->has('video_url')) {
            $videoUrl = $data->input('video_url');
            if ($lesson->video_url && Storage::exists($lesson->video_url)) {
                Storage::delete($lesson->video_url);
            }
        } elseif ($data->video_type === 'file' && $data->hasFile('video_file')) {
            if ($lesson->video_url && Storage::exists($lesson->video_url)) {
                Storage::delete($lesson->video_url);
            }
            $file = $data->file('video_file');
            $videoFile = $this->saveVideo($file, 'public/videos/lesson');
            $videoUrl = $videoFile['link'];
        }

        $params = [
            'course_id' => $data->input('course_id'),
            'title' => $data->input('title'),
            'video_url' => $videoUrl,
            'content' => $data->input('content'),
        ];

        return $this->lessonRepository->update($params, $id);
    }


    // client

    public function getLessonsByCourseId($courseId)
    {
        return $this->lessonRepository->getLessonsByCourseId($courseId);
    }

    public function getLessonByCourseIdAndLessonId($courseId, $lessonId)
    {
        return $this->lessonRepository->getLessonByCourseIdAndLessonId($courseId, $lessonId);
    }
}
