import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Api\UserLessonProgressController::markCompleted
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:15
 * @route '/api/progress/complete-lesson'
 */
export const markCompleted = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: markCompleted.url(options),
    method: 'post',
})

markCompleted.definition = {
    methods: ["post"],
    url: '/api/progress/complete-lesson',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Api\UserLessonProgressController::markCompleted
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:15
 * @route '/api/progress/complete-lesson'
 */
markCompleted.url = (options?: RouteQueryOptions) => {
    return markCompleted.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\UserLessonProgressController::markCompleted
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:15
 * @route '/api/progress/complete-lesson'
 */
markCompleted.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: markCompleted.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Api\UserLessonProgressController::markCompleted
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:15
 * @route '/api/progress/complete-lesson'
 */
    const markCompletedForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: markCompleted.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Api\UserLessonProgressController::markCompleted
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:15
 * @route '/api/progress/complete-lesson'
 */
        markCompletedForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: markCompleted.url(options),
            method: 'post',
        })
    
    markCompleted.form = markCompletedForm
/**
* @see \App\Http\Controllers\Api\UserLessonProgressController::completedLessons
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:64
 * @route '/api/progress/completed-lessons'
 */
export const completedLessons = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: completedLessons.url(options),
    method: 'get',
})

completedLessons.definition = {
    methods: ["get","head"],
    url: '/api/progress/completed-lessons',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\UserLessonProgressController::completedLessons
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:64
 * @route '/api/progress/completed-lessons'
 */
completedLessons.url = (options?: RouteQueryOptions) => {
    return completedLessons.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\UserLessonProgressController::completedLessons
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:64
 * @route '/api/progress/completed-lessons'
 */
completedLessons.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: completedLessons.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\UserLessonProgressController::completedLessons
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:64
 * @route '/api/progress/completed-lessons'
 */
completedLessons.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: completedLessons.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\UserLessonProgressController::completedLessons
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:64
 * @route '/api/progress/completed-lessons'
 */
    const completedLessonsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: completedLessons.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\UserLessonProgressController::completedLessons
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:64
 * @route '/api/progress/completed-lessons'
 */
        completedLessonsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: completedLessons.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\UserLessonProgressController::completedLessons
 * @see app/Http/Controllers/Api/UserLessonProgressController.php:64
 * @route '/api/progress/completed-lessons'
 */
        completedLessonsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: completedLessons.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    completedLessons.form = completedLessonsForm
const UserLessonProgressController = { markCompleted, completedLessons }

export default UserLessonProgressController