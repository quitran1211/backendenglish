import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Api\QuizResultController::saveResult
 * @see app/Http/Controllers/Api/QuizResultController.php:17
 * @route '/api/quiz-results/save'
 */
export const saveResult = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: saveResult.url(options),
    method: 'post',
})

saveResult.definition = {
    methods: ["post"],
    url: '/api/quiz-results/save',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Api\QuizResultController::saveResult
 * @see app/Http/Controllers/Api/QuizResultController.php:17
 * @route '/api/quiz-results/save'
 */
saveResult.url = (options?: RouteQueryOptions) => {
    return saveResult.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\QuizResultController::saveResult
 * @see app/Http/Controllers/Api/QuizResultController.php:17
 * @route '/api/quiz-results/save'
 */
saveResult.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: saveResult.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Api\QuizResultController::saveResult
 * @see app/Http/Controllers/Api/QuizResultController.php:17
 * @route '/api/quiz-results/save'
 */
    const saveResultForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: saveResult.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Api\QuizResultController::saveResult
 * @see app/Http/Controllers/Api/QuizResultController.php:17
 * @route '/api/quiz-results/save'
 */
        saveResultForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: saveResult.url(options),
            method: 'post',
        })
    
    saveResult.form = saveResultForm
/**
* @see \App\Http\Controllers\Api\QuizResultController::getHistory
 * @see app/Http/Controllers/Api/QuizResultController.php:89
 * @route '/api/quiz-results/history'
 */
export const getHistory = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getHistory.url(options),
    method: 'get',
})

getHistory.definition = {
    methods: ["get","head"],
    url: '/api/quiz-results/history',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\QuizResultController::getHistory
 * @see app/Http/Controllers/Api/QuizResultController.php:89
 * @route '/api/quiz-results/history'
 */
getHistory.url = (options?: RouteQueryOptions) => {
    return getHistory.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\QuizResultController::getHistory
 * @see app/Http/Controllers/Api/QuizResultController.php:89
 * @route '/api/quiz-results/history'
 */
getHistory.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getHistory.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\QuizResultController::getHistory
 * @see app/Http/Controllers/Api/QuizResultController.php:89
 * @route '/api/quiz-results/history'
 */
getHistory.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getHistory.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\QuizResultController::getHistory
 * @see app/Http/Controllers/Api/QuizResultController.php:89
 * @route '/api/quiz-results/history'
 */
    const getHistoryForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getHistory.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\QuizResultController::getHistory
 * @see app/Http/Controllers/Api/QuizResultController.php:89
 * @route '/api/quiz-results/history'
 */
        getHistoryForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getHistory.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\QuizResultController::getHistory
 * @see app/Http/Controllers/Api/QuizResultController.php:89
 * @route '/api/quiz-results/history'
 */
        getHistoryForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getHistory.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getHistory.form = getHistoryForm
/**
* @see \App\Http\Controllers\Api\QuizResultController::getDetail
 * @see app/Http/Controllers/Api/QuizResultController.php:107
 * @route '/api/quiz-results/detail'
 */
export const getDetail = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getDetail.url(options),
    method: 'get',
})

getDetail.definition = {
    methods: ["get","head"],
    url: '/api/quiz-results/detail',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\QuizResultController::getDetail
 * @see app/Http/Controllers/Api/QuizResultController.php:107
 * @route '/api/quiz-results/detail'
 */
getDetail.url = (options?: RouteQueryOptions) => {
    return getDetail.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\QuizResultController::getDetail
 * @see app/Http/Controllers/Api/QuizResultController.php:107
 * @route '/api/quiz-results/detail'
 */
getDetail.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getDetail.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\QuizResultController::getDetail
 * @see app/Http/Controllers/Api/QuizResultController.php:107
 * @route '/api/quiz-results/detail'
 */
getDetail.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getDetail.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\QuizResultController::getDetail
 * @see app/Http/Controllers/Api/QuizResultController.php:107
 * @route '/api/quiz-results/detail'
 */
    const getDetailForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getDetail.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\QuizResultController::getDetail
 * @see app/Http/Controllers/Api/QuizResultController.php:107
 * @route '/api/quiz-results/detail'
 */
        getDetailForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getDetail.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\QuizResultController::getDetail
 * @see app/Http/Controllers/Api/QuizResultController.php:107
 * @route '/api/quiz-results/detail'
 */
        getDetailForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getDetail.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getDetail.form = getDetailForm
/**
* @see \App\Http\Controllers\Api\QuizResultController::getStats
 * @see app/Http/Controllers/Api/QuizResultController.php:131
 * @route '/api/quiz-results/stats'
 */
export const getStats = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getStats.url(options),
    method: 'get',
})

getStats.definition = {
    methods: ["get","head"],
    url: '/api/quiz-results/stats',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\QuizResultController::getStats
 * @see app/Http/Controllers/Api/QuizResultController.php:131
 * @route '/api/quiz-results/stats'
 */
getStats.url = (options?: RouteQueryOptions) => {
    return getStats.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\QuizResultController::getStats
 * @see app/Http/Controllers/Api/QuizResultController.php:131
 * @route '/api/quiz-results/stats'
 */
getStats.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getStats.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\QuizResultController::getStats
 * @see app/Http/Controllers/Api/QuizResultController.php:131
 * @route '/api/quiz-results/stats'
 */
getStats.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getStats.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\QuizResultController::getStats
 * @see app/Http/Controllers/Api/QuizResultController.php:131
 * @route '/api/quiz-results/stats'
 */
    const getStatsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getStats.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\QuizResultController::getStats
 * @see app/Http/Controllers/Api/QuizResultController.php:131
 * @route '/api/quiz-results/stats'
 */
        getStatsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getStats.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\QuizResultController::getStats
 * @see app/Http/Controllers/Api/QuizResultController.php:131
 * @route '/api/quiz-results/stats'
 */
        getStatsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getStats.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getStats.form = getStatsForm
/**
* @see \App\Http\Controllers\Api\QuizResultController::checkCompleted
 * @see app/Http/Controllers/Api/QuizResultController.php:163
 * @route '/api/quiz-results/check'
 */
export const checkCompleted = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: checkCompleted.url(options),
    method: 'get',
})

checkCompleted.definition = {
    methods: ["get","head"],
    url: '/api/quiz-results/check',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\QuizResultController::checkCompleted
 * @see app/Http/Controllers/Api/QuizResultController.php:163
 * @route '/api/quiz-results/check'
 */
checkCompleted.url = (options?: RouteQueryOptions) => {
    return checkCompleted.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\QuizResultController::checkCompleted
 * @see app/Http/Controllers/Api/QuizResultController.php:163
 * @route '/api/quiz-results/check'
 */
checkCompleted.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: checkCompleted.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\QuizResultController::checkCompleted
 * @see app/Http/Controllers/Api/QuizResultController.php:163
 * @route '/api/quiz-results/check'
 */
checkCompleted.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: checkCompleted.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\QuizResultController::checkCompleted
 * @see app/Http/Controllers/Api/QuizResultController.php:163
 * @route '/api/quiz-results/check'
 */
    const checkCompletedForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: checkCompleted.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\QuizResultController::checkCompleted
 * @see app/Http/Controllers/Api/QuizResultController.php:163
 * @route '/api/quiz-results/check'
 */
        checkCompletedForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: checkCompleted.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\QuizResultController::checkCompleted
 * @see app/Http/Controllers/Api/QuizResultController.php:163
 * @route '/api/quiz-results/check'
 */
        checkCompletedForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: checkCompleted.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    checkCompleted.form = checkCompletedForm
/**
* @see \App\Http\Controllers\Api\QuizResultController::getVocabularyErrors
 * @see app/Http/Controllers/Api/QuizResultController.php:187
 * @route '/api/quiz-results/vocabulary-errors'
 */
export const getVocabularyErrors = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getVocabularyErrors.url(options),
    method: 'get',
})

getVocabularyErrors.definition = {
    methods: ["get","head"],
    url: '/api/quiz-results/vocabulary-errors',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\QuizResultController::getVocabularyErrors
 * @see app/Http/Controllers/Api/QuizResultController.php:187
 * @route '/api/quiz-results/vocabulary-errors'
 */
getVocabularyErrors.url = (options?: RouteQueryOptions) => {
    return getVocabularyErrors.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\QuizResultController::getVocabularyErrors
 * @see app/Http/Controllers/Api/QuizResultController.php:187
 * @route '/api/quiz-results/vocabulary-errors'
 */
getVocabularyErrors.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getVocabularyErrors.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\QuizResultController::getVocabularyErrors
 * @see app/Http/Controllers/Api/QuizResultController.php:187
 * @route '/api/quiz-results/vocabulary-errors'
 */
getVocabularyErrors.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getVocabularyErrors.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\QuizResultController::getVocabularyErrors
 * @see app/Http/Controllers/Api/QuizResultController.php:187
 * @route '/api/quiz-results/vocabulary-errors'
 */
    const getVocabularyErrorsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getVocabularyErrors.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\QuizResultController::getVocabularyErrors
 * @see app/Http/Controllers/Api/QuizResultController.php:187
 * @route '/api/quiz-results/vocabulary-errors'
 */
        getVocabularyErrorsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getVocabularyErrors.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\QuizResultController::getVocabularyErrors
 * @see app/Http/Controllers/Api/QuizResultController.php:187
 * @route '/api/quiz-results/vocabulary-errors'
 */
        getVocabularyErrorsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getVocabularyErrors.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getVocabularyErrors.form = getVocabularyErrorsForm
const QuizResultController = { saveResult, getHistory, getDetail, getStats, checkCompleted, getVocabularyErrors }

export default QuizResultController