import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Api\QuizQuestionController::index
 * @see app/Http/Controllers/Api/QuizQuestionController.php:12
 * @route '/api/quizzes/{quiz_id}/questions'
 */
export const index = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(args, options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/api/quizzes/{quiz_id}/questions',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\QuizQuestionController::index
 * @see app/Http/Controllers/Api/QuizQuestionController.php:12
 * @route '/api/quizzes/{quiz_id}/questions'
 */
index.url = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { quiz_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    quiz_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz_id: args.quiz_id,
                }

    return index.definition.url
            .replace('{quiz_id}', parsedArgs.quiz_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\QuizQuestionController::index
 * @see app/Http/Controllers/Api/QuizQuestionController.php:12
 * @route '/api/quizzes/{quiz_id}/questions'
 */
index.get = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\QuizQuestionController::index
 * @see app/Http/Controllers/Api/QuizQuestionController.php:12
 * @route '/api/quizzes/{quiz_id}/questions'
 */
index.head = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\QuizQuestionController::index
 * @see app/Http/Controllers/Api/QuizQuestionController.php:12
 * @route '/api/quizzes/{quiz_id}/questions'
 */
    const indexForm = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\QuizQuestionController::index
 * @see app/Http/Controllers/Api/QuizQuestionController.php:12
 * @route '/api/quizzes/{quiz_id}/questions'
 */
        indexForm.get = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\QuizQuestionController::index
 * @see app/Http/Controllers/Api/QuizQuestionController.php:12
 * @route '/api/quizzes/{quiz_id}/questions'
 */
        indexForm.head = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index.form = indexForm
/**
* @see \App\Http\Controllers\Api\QuizQuestionController::submit
 * @see app/Http/Controllers/Api/QuizQuestionController.php:39
 * @route '/api/quizzes/{quiz_id}/submit'
 */
export const submit = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: submit.url(args, options),
    method: 'post',
})

submit.definition = {
    methods: ["post"],
    url: '/api/quizzes/{quiz_id}/submit',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Api\QuizQuestionController::submit
 * @see app/Http/Controllers/Api/QuizQuestionController.php:39
 * @route '/api/quizzes/{quiz_id}/submit'
 */
submit.url = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { quiz_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    quiz_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz_id: args.quiz_id,
                }

    return submit.definition.url
            .replace('{quiz_id}', parsedArgs.quiz_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\QuizQuestionController::submit
 * @see app/Http/Controllers/Api/QuizQuestionController.php:39
 * @route '/api/quizzes/{quiz_id}/submit'
 */
submit.post = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: submit.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Api\QuizQuestionController::submit
 * @see app/Http/Controllers/Api/QuizQuestionController.php:39
 * @route '/api/quizzes/{quiz_id}/submit'
 */
    const submitForm = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: submit.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Api\QuizQuestionController::submit
 * @see app/Http/Controllers/Api/QuizQuestionController.php:39
 * @route '/api/quizzes/{quiz_id}/submit'
 */
        submitForm.post = (args: { quiz_id: string | number } | [quiz_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: submit.url(args, options),
            method: 'post',
        })
    
    submit.form = submitForm
const QuizQuestionController = { index, submit }

export default QuizQuestionController