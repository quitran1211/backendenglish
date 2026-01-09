import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Api\VocabularyController::show
 * @see app/Http/Controllers/Api/VocabularyController.php:15
 * @route '/api/vocabularies/{id}'
 */
export const show = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/api/vocabularies/{id}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\VocabularyController::show
 * @see app/Http/Controllers/Api/VocabularyController.php:15
 * @route '/api/vocabularies/{id}'
 */
show.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        id: args.id,
                }

    return show.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\VocabularyController::show
 * @see app/Http/Controllers/Api/VocabularyController.php:15
 * @route '/api/vocabularies/{id}'
 */
show.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\VocabularyController::show
 * @see app/Http/Controllers/Api/VocabularyController.php:15
 * @route '/api/vocabularies/{id}'
 */
show.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\VocabularyController::show
 * @see app/Http/Controllers/Api/VocabularyController.php:15
 * @route '/api/vocabularies/{id}'
 */
    const showForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\VocabularyController::show
 * @see app/Http/Controllers/Api/VocabularyController.php:15
 * @route '/api/vocabularies/{id}'
 */
        showForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\VocabularyController::show
 * @see app/Http/Controllers/Api/VocabularyController.php:15
 * @route '/api/vocabularies/{id}'
 */
        showForm.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
/**
* @see \App\Http\Controllers\Api\VocabularyController::getByLesson
 * @see app/Http/Controllers/Api/VocabularyController.php:55
 * @route '/api/lessons/{lessonId}/vocabularies'
 */
export const getByLesson = (args: { lessonId: string | number } | [lessonId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getByLesson.url(args, options),
    method: 'get',
})

getByLesson.definition = {
    methods: ["get","head"],
    url: '/api/lessons/{lessonId}/vocabularies',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\VocabularyController::getByLesson
 * @see app/Http/Controllers/Api/VocabularyController.php:55
 * @route '/api/lessons/{lessonId}/vocabularies'
 */
getByLesson.url = (args: { lessonId: string | number } | [lessonId: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lessonId: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lessonId: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lessonId: args.lessonId,
                }

    return getByLesson.definition.url
            .replace('{lessonId}', parsedArgs.lessonId.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\VocabularyController::getByLesson
 * @see app/Http/Controllers/Api/VocabularyController.php:55
 * @route '/api/lessons/{lessonId}/vocabularies'
 */
getByLesson.get = (args: { lessonId: string | number } | [lessonId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getByLesson.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\VocabularyController::getByLesson
 * @see app/Http/Controllers/Api/VocabularyController.php:55
 * @route '/api/lessons/{lessonId}/vocabularies'
 */
getByLesson.head = (args: { lessonId: string | number } | [lessonId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getByLesson.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\VocabularyController::getByLesson
 * @see app/Http/Controllers/Api/VocabularyController.php:55
 * @route '/api/lessons/{lessonId}/vocabularies'
 */
    const getByLessonForm = (args: { lessonId: string | number } | [lessonId: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getByLesson.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\VocabularyController::getByLesson
 * @see app/Http/Controllers/Api/VocabularyController.php:55
 * @route '/api/lessons/{lessonId}/vocabularies'
 */
        getByLessonForm.get = (args: { lessonId: string | number } | [lessonId: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getByLesson.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\VocabularyController::getByLesson
 * @see app/Http/Controllers/Api/VocabularyController.php:55
 * @route '/api/lessons/{lessonId}/vocabularies'
 */
        getByLessonForm.head = (args: { lessonId: string | number } | [lessonId: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getByLesson.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getByLesson.form = getByLessonForm
const VocabularyController = { show, getByLesson }

export default VocabularyController