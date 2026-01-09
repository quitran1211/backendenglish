import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::index
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:16
 * @route '/admin/quizzes/{quiz}/questions'
 */
export const index = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(args, options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/questions',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::index
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:16
 * @route '/admin/quizzes/{quiz}/questions'
 */
index.url = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { quiz: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { quiz: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: typeof args.quiz === 'object'
                ? args.quiz.id
                : args.quiz,
                }

    return index.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::index
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:16
 * @route '/admin/quizzes/{quiz}/questions'
 */
index.get = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::index
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:16
 * @route '/admin/quizzes/{quiz}/questions'
 */
index.head = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::index
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:16
 * @route '/admin/quizzes/{quiz}/questions'
 */
    const indexForm = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::index
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:16
 * @route '/admin/quizzes/{quiz}/questions'
 */
        indexForm.get = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::index
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:16
 * @route '/admin/quizzes/{quiz}/questions'
 */
        indexForm.head = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\QuizQuestionController::create
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:29
 * @route '/admin/quizzes/{quiz}/questions/create'
 */
export const create = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(args, options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/questions/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::create
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:29
 * @route '/admin/quizzes/{quiz}/questions/create'
 */
create.url = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { quiz: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { quiz: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: typeof args.quiz === 'object'
                ? args.quiz.id
                : args.quiz,
                }

    return create.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::create
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:29
 * @route '/admin/quizzes/{quiz}/questions/create'
 */
create.get = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::create
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:29
 * @route '/admin/quizzes/{quiz}/questions/create'
 */
create.head = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::create
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:29
 * @route '/admin/quizzes/{quiz}/questions/create'
 */
    const createForm = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::create
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:29
 * @route '/admin/quizzes/{quiz}/questions/create'
 */
        createForm.get = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::create
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:29
 * @route '/admin/quizzes/{quiz}/questions/create'
 */
        createForm.head = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    create.form = createForm
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::store
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:39
 * @route '/admin/quizzes/{quiz}/questions'
 */
export const store = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/quizzes/{quiz}/questions',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::store
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:39
 * @route '/admin/quizzes/{quiz}/questions'
 */
store.url = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { quiz: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { quiz: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: typeof args.quiz === 'object'
                ? args.quiz.id
                : args.quiz,
                }

    return store.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::store
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:39
 * @route '/admin/quizzes/{quiz}/questions'
 */
store.post = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::store
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:39
 * @route '/admin/quizzes/{quiz}/questions'
 */
    const storeForm = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::store
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:39
 * @route '/admin/quizzes/{quiz}/questions'
 */
        storeForm.post = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(args, options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::show
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:152
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
export const show = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/questions/{question}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::show
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:152
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
show.url = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                    question: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: args.quiz,
                                question: args.question,
                }

    return show.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace('{question}', parsedArgs.question.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::show
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:152
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
show.get = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::show
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:152
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
show.head = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::show
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:152
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
    const showForm = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::show
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:152
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
        showForm.get = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::show
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:152
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
        showForm.head = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\QuizQuestionController::edit
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:67
 * @route '/admin/quizzes/{quiz}/questions/{question}/edit'
 */
export const edit = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/questions/{question}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::edit
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:67
 * @route '/admin/quizzes/{quiz}/questions/{question}/edit'
 */
edit.url = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                    question: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: args.quiz,
                                question: typeof args.question === 'object'
                ? args.question.id
                : args.question,
                }

    return edit.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace('{question}', parsedArgs.question.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::edit
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:67
 * @route '/admin/quizzes/{quiz}/questions/{question}/edit'
 */
edit.get = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::edit
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:67
 * @route '/admin/quizzes/{quiz}/questions/{question}/edit'
 */
edit.head = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::edit
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:67
 * @route '/admin/quizzes/{quiz}/questions/{question}/edit'
 */
    const editForm = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::edit
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:67
 * @route '/admin/quizzes/{quiz}/questions/{question}/edit'
 */
        editForm.get = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::edit
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:67
 * @route '/admin/quizzes/{quiz}/questions/{question}/edit'
 */
        editForm.head = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    edit.form = editForm
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::update
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:77
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
export const update = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/quizzes/{quiz}/questions/{question}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::update
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:77
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
update.url = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                    question: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: args.quiz,
                                question: typeof args.question === 'object'
                ? args.question.id
                : args.question,
                }

    return update.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace('{question}', parsedArgs.question.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::update
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:77
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
update.put = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::update
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:77
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
    const updateForm = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::update
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:77
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
        updateForm.put = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::destroy
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:101
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
export const destroy = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/quizzes/{quiz}/questions/{question}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::destroy
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:101
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
destroy.url = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                    question: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: args.quiz,
                                question: typeof args.question === 'object'
                ? args.question.id
                : args.question,
                }

    return destroy.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace('{question}', parsedArgs.question.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::destroy
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:101
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
destroy.delete = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::destroy
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:101
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
    const destroyForm = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::destroy
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:101
 * @route '/admin/quizzes/{quiz}/questions/{question}'
 */
        destroyForm.delete = (args: { quiz: string | number, question: string | number | { id: string | number } } | [quiz: string | number, question: string | number | { id: string | number } ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::trash
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:111
 * @route '/admin/quizzes/{quiz}/questions/trash'
 */
export const trash = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(args, options),
    method: 'get',
})

trash.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/questions/trash',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::trash
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:111
 * @route '/admin/quizzes/{quiz}/questions/trash'
 */
trash.url = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { quiz: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: args.quiz,
                }

    return trash.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::trash
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:111
 * @route '/admin/quizzes/{quiz}/questions/trash'
 */
trash.get = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::trash
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:111
 * @route '/admin/quizzes/{quiz}/questions/trash'
 */
trash.head = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: trash.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::trash
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:111
 * @route '/admin/quizzes/{quiz}/questions/trash'
 */
    const trashForm = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: trash.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::trash
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:111
 * @route '/admin/quizzes/{quiz}/questions/trash'
 */
        trashForm.get = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: trash.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::trash
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:111
 * @route '/admin/quizzes/{quiz}/questions/trash'
 */
        trashForm.head = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: trash.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    trash.form = trashForm
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::restore
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:125
 * @route '/admin/quizzes/{quiz}/questions/{id}/restore'
 */
export const restore = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: restore.url(args, options),
    method: 'post',
})

restore.definition = {
    methods: ["post"],
    url: '/admin/quizzes/{quiz}/questions/{id}/restore',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::restore
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:125
 * @route '/admin/quizzes/{quiz}/questions/{id}/restore'
 */
restore.url = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                    id: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: args.quiz,
                                id: args.id,
                }

    return restore.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::restore
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:125
 * @route '/admin/quizzes/{quiz}/questions/{id}/restore'
 */
restore.post = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: restore.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::restore
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:125
 * @route '/admin/quizzes/{quiz}/questions/{id}/restore'
 */
    const restoreForm = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: restore.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::restore
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:125
 * @route '/admin/quizzes/{quiz}/questions/{id}/restore'
 */
        restoreForm.post = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: restore.url(args, options),
            method: 'post',
        })
    
    restore.form = restoreForm
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::forceDelete
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:136
 * @route '/admin/quizzes/{quiz}/questions/{id}/force-delete'
 */
export const forceDelete = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

forceDelete.definition = {
    methods: ["delete"],
    url: '/admin/quizzes/{quiz}/questions/{id}/force-delete',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::forceDelete
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:136
 * @route '/admin/quizzes/{quiz}/questions/{id}/force-delete'
 */
forceDelete.url = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                    id: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: args.quiz,
                                id: args.id,
                }

    return forceDelete.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::forceDelete
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:136
 * @route '/admin/quizzes/{quiz}/questions/{id}/force-delete'
 */
forceDelete.delete = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::forceDelete
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:136
 * @route '/admin/quizzes/{quiz}/questions/{id}/force-delete'
 */
    const forceDeleteForm = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: forceDelete.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::forceDelete
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:136
 * @route '/admin/quizzes/{quiz}/questions/{id}/force-delete'
 */
        forceDeleteForm.delete = (args: { quiz: string | number, id: string | number } | [quiz: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: forceDelete.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    forceDelete.form = forceDeleteForm
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:144
 * @route '/admin/quizzes/{quiz}/questions/{question}/delete'
 */
export const deleteMethod = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: deleteMethod.url(args, options),
    method: 'get',
})

deleteMethod.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/questions/{question}/delete',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:144
 * @route '/admin/quizzes/{quiz}/questions/{question}/delete'
 */
deleteMethod.url = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    quiz: args[0],
                    question: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        quiz: args.quiz,
                                question: args.question,
                }

    return deleteMethod.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace('{question}', parsedArgs.question.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:144
 * @route '/admin/quizzes/{quiz}/questions/{question}/delete'
 */
deleteMethod.get = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: deleteMethod.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizQuestionController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:144
 * @route '/admin/quizzes/{quiz}/questions/{question}/delete'
 */
deleteMethod.head = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: deleteMethod.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:144
 * @route '/admin/quizzes/{quiz}/questions/{question}/delete'
 */
    const deleteMethodForm = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: deleteMethod.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:144
 * @route '/admin/quizzes/{quiz}/questions/{question}/delete'
 */
        deleteMethodForm.get = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: deleteMethod.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizQuestionController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizQuestionController.php:144
 * @route '/admin/quizzes/{quiz}/questions/{question}/delete'
 */
        deleteMethodForm.head = (args: { quiz: string | number, question: string | number } | [quiz: string | number, question: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: deleteMethod.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    deleteMethod.form = deleteMethodForm
const questions = {
    index: Object.assign(index, index),
create: Object.assign(create, create),
store: Object.assign(store, store),
show: Object.assign(show, show),
edit: Object.assign(edit, edit),
update: Object.assign(update, update),
destroy: Object.assign(destroy, destroy),
trash: Object.assign(trash, trash),
restore: Object.assign(restore, restore),
forceDelete: Object.assign(forceDelete, forceDelete),
delete: Object.assign(deleteMethod, deleteMethod),
}

export default questions