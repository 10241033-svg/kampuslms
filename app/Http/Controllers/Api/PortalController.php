<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @deprecated Gunakan controller terdedikasi:
 * - DashboardController
 * - UserApiController
 * - CourseApiController
 * - CourseEnrollmentController
 * - MaterialApiController
 */
class PortalController extends Controller
{
    public function dashboard(Request $request): JsonResponse
    {
        return app(DashboardController::class)->index($request);
    }

    public function users(Request $request): JsonResponse
    {
        return app(UserApiController::class)->index($request);
    }

    public function storeUser(StoreUserRequest $request): JsonResponse
    {
        return app(UserApiController::class)->store($request);
    }

    public function updateUser(UpdateUserRequest $request, User $user): JsonResponse
    {
        return app(UserApiController::class)->update($request, $user);
    }

    public function updateCurrentUser(Request $request): UserResource
    {
        return app(UserApiController::class)->updateCurrentUser($request);
    }

    public function showUser(Request $request, User $user): JsonResponse
    {
        return app(UserApiController::class)->show($request, $user);
    }

    public function destroyUser(Request $request, User $user): JsonResponse
    {
        return app(UserApiController::class)->destroy($request, $user);
    }

    public function lecturers(Request $request): JsonResponse
    {
        return app(UserApiController::class)->lecturers($request);
    }

    public function storeCourse(StoreCourseRequest $request): JsonResponse
    {
        return app(CourseApiController::class)->store($request);
    }

    public function updateCourse(UpdateCourseRequest $request, Course $course): JsonResponse
    {
        return app(CourseApiController::class)->update($request, $course);
    }

    public function destroyCourse(Request $request, Course $course): JsonResponse
    {
        return app(CourseApiController::class)->destroy($request, $course);
    }

    public function storeMaterial(StoreMaterialRequest $request, Course $course): JsonResponse
    {
        return app(MaterialApiController::class)->store($request, $course);
    }

    public function showMaterial(Request $request, Material $material): JsonResponse
    {
        return app(MaterialApiController::class)->show($request, $material);
    }

    public function downloadMaterial(Request $request, Material $material)
    {
        return app(MaterialApiController::class)->download($request, $material);
    }

    public function updateMaterial(UpdateMaterialRequest $request, Material $material): JsonResponse
    {
        return app(MaterialApiController::class)->update($request, $material);
    }

    public function destroyMaterial(Request $request, Material $material): JsonResponse
    {
        return app(MaterialApiController::class)->destroy($request, $material);
    }

    public function enrollmentCandidates(Request $request, Course $course): JsonResponse
    {
        return app(CourseEnrollmentController::class)->candidates($request, $course);
    }

    public function courseStudents(Request $request, Course $course): JsonResponse
    {
        return app(CourseEnrollmentController::class)->students($request, $course);
    }

    public function storeEnrollment(StoreEnrollmentRequest $request, Course $course): JsonResponse
    {
        return app(CourseEnrollmentController::class)->store($request, $course);
    }

    public function destroyEnrollment(Request $request, Course $course, User $user): JsonResponse
    {
        return app(CourseEnrollmentController::class)->destroy($request, $course, $user);
    }
}
