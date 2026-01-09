import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
import questions from './questions'
/**
* @see \App\Http\Controllers\Admin\QuizController::index
 * @see app/Http/Controllers/Admin/QuizController.php:16
 * @route '/admin/quizzes'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::index
 * @see app/Http/Controllers/Admin/QuizController.php:16
 * @route '/admin/quizzes'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::index
 * @see app/Http/Controllers/Admin/QuizController.php:16
 * @route '/admin/quizzes'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizController::index
 * @see app/Http/Controllers/Admin/QuizController.php:16
 * @route '/admin/quizzes'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::index
 * @see app/Http/Controllers/Admin/QuizController.php:16
 * @route '/admin/quizzes'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::index
 * @see app/Http/Controllers/Admin/QuizController.php:16
 * @route '/admin/quizzes'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizController::index
 * @see app/Http/Controllers/Admin/QuizController.php:16
 * @route '/admin/quizzes'
 */
        indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index.form = indexForm
/**
* @see \App\Http\Controllers\Admin\QuizController::create
 * @see app/Http/Controllers/Admin/QuizController.php:29
 * @route '/admin/quizzes/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::create
 * @see app/Http/Controllers/Admin/QuizController.php:29
 * @route '/admin/quizzes/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::create
 * @see app/Http/Controllers/Admin/QuizController.php:29
 * @route '/admin/quizzes/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizController::create
 * @see app/Http/Controllers/Admin/QuizController.php:29
 * @route '/admin/quizzes/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::create
 * @see app/Http/Controllers/Admin/QuizController.php:29
 * @route '/admin/quizzes/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::create
 * @see app/Http/Controllers/Admin/QuizController.php:29
 * @route '/admin/quizzes/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizController::create
 * @see app/Http/Controllers/Admin/QuizController.php:29
 * @route '/admin/quizzes/create'
 */
        createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    create.form = createForm
/**
* @see \App\Http\Controllers\Admin\QuizController::store
 * @see app/Http/Controllers/Admin/QuizController.php:40
 * @route '/admin/quizzes'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/quizzes',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::store
 * @see app/Http/Controllers/Admin/QuizController.php:40
 * @route '/admin/quizzes'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::store
 * @see app/Http/Controllers/Admin/QuizController.php:40
 * @route '/admin/quizzes'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::store
 * @see app/Http/Controllers/Admin/QuizController.php:40
 * @route '/admin/quizzes'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::store
 * @see app/Http/Controllers/Admin/QuizController.php:40
 * @route '/admin/quizzes'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\QuizController::show
 * @see app/Http/Controllers/Admin/QuizController.php:94
 * @route '/admin/quizzes/{quiz}'
 */
export const show = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::show
 * @see app/Http/Controllers/Admin/QuizController.php:94
 * @route '/admin/quizzes/{quiz}'
 */
show.url = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return show.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::show
 * @see app/Http/Controllers/Admin/QuizController.php:94
 * @route '/admin/quizzes/{quiz}'
 */
show.get = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizController::show
 * @see app/Http/Controllers/Admin/QuizController.php:94
 * @route '/admin/quizzes/{quiz}'
 */
show.head = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::show
 * @see app/Http/Controllers/Admin/QuizController.php:94
 * @route '/admin/quizzes/{quiz}'
 */
    const showForm = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::show
 * @see app/Http/Controllers/Admin/QuizController.php:94
 * @route '/admin/quizzes/{quiz}'
 */
        showForm.get = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizController::show
 * @see app/Http/Controllers/Admin/QuizController.php:94
 * @route '/admin/quizzes/{quiz}'
 */
        showForm.head = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\QuizController::edit
 * @see app/Http/Controllers/Admin/QuizController.php:63
 * @route '/admin/quizzes/{quiz}/edit'
 */
export const edit = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::edit
 * @see app/Http/Controllers/Admin/QuizController.php:63
 * @route '/admin/quizzes/{quiz}/edit'
 */
edit.url = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return edit.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::edit
 * @see app/Http/Controllers/Admin/QuizController.php:63
 * @route '/admin/quizzes/{quiz}/edit'
 */
edit.get = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizController::edit
 * @see app/Http/Controllers/Admin/QuizController.php:63
 * @route '/admin/quizzes/{quiz}/edit'
 */
edit.head = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::edit
 * @see app/Http/Controllers/Admin/QuizController.php:63
 * @route '/admin/quizzes/{quiz}/edit'
 */
    const editForm = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::edit
 * @see app/Http/Controllers/Admin/QuizController.php:63
 * @route '/admin/quizzes/{quiz}/edit'
 */
        editForm.get = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizController::edit
 * @see app/Http/Controllers/Admin/QuizController.php:63
 * @route '/admin/quizzes/{quiz}/edit'
 */
        editForm.head = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\QuizController::update
 * @see app/Http/Controllers/Admin/QuizController.php:74
 * @route '/admin/quizzes/{quiz}'
 */
export const update = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/quizzes/{quiz}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::update
 * @see app/Http/Controllers/Admin/QuizController.php:74
 * @route '/admin/quizzes/{quiz}'
 */
update.url = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return update.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::update
 * @see app/Http/Controllers/Admin/QuizController.php:74
 * @route '/admin/quizzes/{quiz}'
 */
update.put = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::update
 * @see app/Http/Controllers/Admin/QuizController.php:74
 * @route '/admin/quizzes/{quiz}'
 */
    const updateForm = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::update
 * @see app/Http/Controllers/Admin/QuizController.php:74
 * @route '/admin/quizzes/{quiz}'
 */
        updateForm.put = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\QuizController::destroy
 * @see app/Http/Controllers/Admin/QuizController.php:118
 * @route '/admin/quizzes/{quiz}'
 */
export const destroy = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/quizzes/{quiz}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::destroy
 * @see app/Http/Controllers/Admin/QuizController.php:118
 * @route '/admin/quizzes/{quiz}'
 */
destroy.url = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::destroy
 * @see app/Http/Controllers/Admin/QuizController.php:118
 * @route '/admin/quizzes/{quiz}'
 */
destroy.delete = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::destroy
 * @see app/Http/Controllers/Admin/QuizController.php:118
 * @route '/admin/quizzes/{quiz}'
 */
    const destroyForm = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::destroy
 * @see app/Http/Controllers/Admin/QuizController.php:118
 * @route '/admin/quizzes/{quiz}'
 */
        destroyForm.delete = (args: { quiz: string | number | { id: string | number } } | [quiz: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\QuizController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizController.php:125
 * @route '/admin/quizzes/{quiz}/delete'
 */
export const deleteMethod = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: deleteMethod.url(args, options),
    method: 'get',
})

deleteMethod.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/delete',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizController.php:125
 * @route '/admin/quizzes/{quiz}/delete'
 */
deleteMethod.url = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return deleteMethod.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizController.php:125
 * @route '/admin/quizzes/{quiz}/delete'
 */
deleteMethod.get = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: deleteMethod.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizController.php:125
 * @route '/admin/quizzes/{quiz}/delete'
 */
deleteMethod.head = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: deleteMethod.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizController.php:125
 * @route '/admin/quizzes/{quiz}/delete'
 */
    const deleteMethodForm = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: deleteMethod.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizController.php:125
 * @route '/admin/quizzes/{quiz}/delete'
 */
        deleteMethodForm.get = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: deleteMethod.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizController::deleteMethod
 * @see app/Http/Controllers/Admin/QuizController.php:125
 * @route '/admin/quizzes/{quiz}/delete'
 */
        deleteMethodForm.head = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: deleteMethod.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    deleteMethod.form = deleteMethodForm
/**
* @see \App\Http\Controllers\Admin\QuizController::toggleStatus
 * @see app/Http/Controllers/Admin/QuizController.php:104
 * @route '/admin/quizzes/{quiz}/toggle-status'
 */
export const toggleStatus = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: toggleStatus.url(args, options),
    method: 'get',
})

toggleStatus.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{quiz}/toggle-status',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::toggleStatus
 * @see app/Http/Controllers/Admin/QuizController.php:104
 * @route '/admin/quizzes/{quiz}/toggle-status'
 */
toggleStatus.url = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return toggleStatus.definition.url
            .replace('{quiz}', parsedArgs.quiz.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::toggleStatus
 * @see app/Http/Controllers/Admin/QuizController.php:104
 * @route '/admin/quizzes/{quiz}/toggle-status'
 */
toggleStatus.get = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: toggleStatus.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizController::toggleStatus
 * @see app/Http/Controllers/Admin/QuizController.php:104
 * @route '/admin/quizzes/{quiz}/toggle-status'
 */
toggleStatus.head = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: toggleStatus.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::toggleStatus
 * @see app/Http/Controllers/Admin/QuizController.php:104
 * @route '/admin/quizzes/{quiz}/toggle-status'
 */
    const toggleStatusForm = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: toggleStatus.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::toggleStatus
 * @see app/Http/Controllers/Admin/QuizController.php:104
 * @route '/admin/quizzes/{quiz}/toggle-status'
 */
        toggleStatusForm.get = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: toggleStatus.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizController::toggleStatus
 * @see app/Http/Controllers/Admin/QuizController.php:104
 * @route '/admin/quizzes/{quiz}/toggle-status'
 */
        toggleStatusForm.head = (args: { quiz: string | number } | [quiz: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: toggleStatus.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    toggleStatus.form = toggleStatusForm
/**
* @see \App\Http\Controllers\Admin\QuizController::trash
 * @see app/Http/Controllers/Admin/QuizController.php:136
 * @route '/admin/quizzes/trash'
 */
export const trash = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})

trash.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/trash',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::trash
 * @see app/Http/Controllers/Admin/QuizController.php:136
 * @route '/admin/quizzes/trash'
 */
trash.url = (options?: RouteQueryOptions) => {
    return trash.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::trash
 * @see app/Http/Controllers/Admin/QuizController.php:136
 * @route '/admin/quizzes/trash'
 */
trash.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizController::trash
 * @see app/Http/Controllers/Admin/QuizController.php:136
 * @route '/admin/quizzes/trash'
 */
trash.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: trash.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::trash
 * @see app/Http/Controllers/Admin/QuizController.php:136
 * @route '/admin/quizzes/trash'
 */
    const trashForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: trash.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::trash
 * @see app/Http/Controllers/Admin/QuizController.php:136
 * @route '/admin/quizzes/trash'
 */
        trashForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: trash.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizController::trash
 * @see app/Http/Controllers/Admin/QuizController.php:136
 * @route '/admin/quizzes/trash'
 */
        trashForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: trash.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    trash.form = trashForm
/**
* @see \App\Http\Controllers\Admin\QuizController::restore
 * @see app/Http/Controllers/Admin/QuizController.php:148
 * @route '/admin/quizzes/{id}/restore'
 */
export const restore = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: restore.url(args, options),
    method: 'get',
})

restore.definition = {
    methods: ["get","head"],
    url: '/admin/quizzes/{id}/restore',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::restore
 * @see app/Http/Controllers/Admin/QuizController.php:148
 * @route '/admin/quizzes/{id}/restore'
 */
restore.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return restore.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::restore
 * @see app/Http/Controllers/Admin/QuizController.php:148
 * @route '/admin/quizzes/{id}/restore'
 */
restore.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: restore.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\QuizController::restore
 * @see app/Http/Controllers/Admin/QuizController.php:148
 * @route '/admin/quizzes/{id}/restore'
 */
restore.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: restore.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::restore
 * @see app/Http/Controllers/Admin/QuizController.php:148
 * @route '/admin/quizzes/{id}/restore'
 */
    const restoreForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: restore.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::restore
 * @see app/Http/Controllers/Admin/QuizController.php:148
 * @route '/admin/quizzes/{id}/restore'
 */
        restoreForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: restore.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\QuizController::restore
 * @see app/Http/Controllers/Admin/QuizController.php:148
 * @route '/admin/quizzes/{id}/restore'
 */
        restoreForm.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: restore.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    restore.form = restoreForm
/**
* @see \App\Http\Controllers\Admin\QuizController::forceDelete
 * @see app/Http/Controllers/Admin/QuizController.php:159
 * @route '/admin/quizzes/{id}/force-delete'
 */
export const forceDelete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

forceDelete.definition = {
    methods: ["delete"],
    url: '/admin/quizzes/{id}/force-delete',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\QuizController::forceDelete
 * @see app/Http/Controllers/Admin/QuizController.php:159
 * @route '/admin/quizzes/{id}/force-delete'
 */
forceDelete.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return forceDelete.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\QuizController::forceDelete
 * @see app/Http/Controllers/Admin/QuizController.php:159
 * @route '/admin/quizzes/{id}/force-delete'
 */
forceDelete.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\QuizController::forceDelete
 * @see app/Http/Controllers/Admin/QuizController.php:159
 * @route '/admin/quizzes/{id}/force-delete'
 */
    const forceDeleteForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: forceDelete.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\QuizController::forceDelete
 * @see app/Http/Controllers/Admin/QuizController.php:159
 * @route '/admin/quizzes/{id}/force-delete'
 */
        forceDeleteForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: forceDelete.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    forceDelete.form = forceDeleteForm
const quizzes = {
    index: Object.assign(index, index),
create: Object.assign(create, create),
store: Object.assign(store, store),
show: Object.assign(show, show),
edit: Object.assign(edit, edit),
update: Object.assign(update, update),
destroy: Object.assign(destroy, destroy),
delete: Object.assign(deleteMethod, deleteMethod),
toggleStatus: Object.assign(toggleStatus, toggleStatus),
trash: Object.assign(trash, trash),
restore: Object.assign(restore, restore),
forceDelete: Object.assign(forceDelete, forceDelete),
questions: Object.assign(questions, questions),
}

export default quizzes