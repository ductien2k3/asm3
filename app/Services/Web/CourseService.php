<?php

namespace App\Services\Web;

use App\Models\Course;
use App\Repositories\Contracts\CourseRepository;
use App\Services\Contracts\CourseServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseService implements CourseServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAllCourse()
    {
        $userId = Auth::id();
        $courses = Course::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('category')
            ->orderBy('updated_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->withQueryString();

        return $courses;
    }

    public function create($data)
    {
    }

    public function store($data)
    {
        $imagePath = null;
        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $imagePath = $image->store(PATH_IMAGE_COURSES, PATH_IMAGE);
        }
        $params = [
            'category_id' => $data->category_id,
            'title' => $data->title,
            'image' => $imagePath,
            'description' => $data->description,
            'price' => $data->price,
            'location' => $data->location,
            'schedule' => $data->schedule,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
        ];
        $course = $this->courseRepository->create($params);
        return $course;
    }

    public function edit($id)
    {
        return $this->courseRepository->find($id);
    }
    public function update($data, $id)
    {
        $course = $this->courseRepository->find($id);
        $imagePath = $course->image;
        $newImagePath = $imagePath;
        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $newImagePath = $image->store(PATH_IMAGE_COURSES, PATH_IMAGE);
            if ($imagePath && Storage::exists(PATH_IMAGE . '/' . $imagePath)) {
                Storage::delete(PATH_IMAGE . '/' . $imagePath);
            }
        }
        $params = [
            'category_id' => $data->category_id,
            'title' => $data->title,
            'image' => $newImagePath,
            'description' => $data->description,
            'price' => $data->price,
            'location' => $data->location,
            'schedule' => $data->schedule,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
        ];

        return $this->courseRepository->update($params, $id);
    }

    // client

    public function getAllCourseHome()
    {
        $orderBy['updated_at'] = 'desc';
        $filter = [];
        $courses = $this->courseRepository->paginateByFilters(
            $filter,
            PAGINATE_MAX_RECORD,
            ['category'],
            $orderBy
        )->withQueryString();
        return $courses;
    }
}