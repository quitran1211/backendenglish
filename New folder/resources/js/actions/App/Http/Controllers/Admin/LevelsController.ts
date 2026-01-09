import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\LevelsController::index
 * @see app/Http/Controllers/Admin/LevelsController.php:14
 * @route '/admin/levels'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/levels',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::index
 * @see app/Http/Controllers/Admin/LevelsController.php:14
 * @route '/admin/levels'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::index
 * @see app/Http/Controllers/Admin/LevelsController.php:14
 * @route '/admin/levels'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LevelsController::index
 * @see app/Http/Controllers/Admin/LevelsController.php:14
 * @route '/admin/levels'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::index
 * @see app/Http/Controllers/Admin/LevelsController.php:14
 * @route '/admin/levels'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::index
 * @see app/Http/Controllers/Admin/LevelsController.php:14
 * @route '/admin/levels'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LevelsController::index
 * @see app/Http/Controllers/Admin/LevelsController.php:14
 * @route '/admin/levels'
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
* @see \App\Http\Controllers\Admin\LevelsController::create
 * @see app/Http/Controllers/Admin/LevelsController.php:26
 * @route '/admin/levels/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/levels/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::create
 * @see app/Http/Controllers/Admin/LevelsController.php:26
 * @route '/admin/levels/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::create
 * @see app/Http/Controllers/Admin/LevelsController.php:26
 * @route '/admin/levels/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LevelsController::create
 * @see app/Http/Controllers/Admin/LevelsController.php:26
 * @route '/admin/levels/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::create
 * @see app/Http/Controllers/Admin/LevelsController.php:26
 * @route '/admin/levels/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::create
 * @see app/Http/Controllers/Admin/LevelsController.php:26
 * @route '/admin/levels/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LevelsController::create
 * @see app/Http/Controllers/Admin/LevelsController.php:26
 * @route '/admin/levels/create'
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
* @see \App\Http\Controllers\Admin\LevelsController::store
 * @see app/Http/Controllers/Admin/LevelsController.php:34
 * @route '/admin/levels'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/levels',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::store
 * @see app/Http/Controllers/Admin/LevelsController.php:34
 * @route '/admin/levels'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::store
 * @see app/Http/Controllers/Admin/LevelsController.php:34
 * @route '/admin/levels'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::store
 * @see app/Http/Controllers/Admin/LevelsController.php:34
 * @route '/admin/levels'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::store
 * @see app/Http/Controllers/Admin/LevelsController.php:34
 * @route '/admin/levels'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\LevelsController::trash
 * @see app/Http/Controllers/Admin/LevelsController.php:112
 * @route '/admin/levels/trash'
 */
export const trash = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})

trash.definition = {
    methods: ["get","head"],
    url: '/admin/levels/trash',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::trash
 * @see app/Http/Controllers/Admin/LevelsController.php:112
 * @route '/admin/levels/trash'
 */
trash.url = (options?: RouteQueryOptions) => {
    return trash.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::trash
 * @see app/Http/Controllers/Admin/LevelsController.php:112
 * @route '/admin/levels/trash'
 */
trash.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LevelsController::trash
 * @see app/Http/Controllers/Admin/LevelsController.php:112
 * @route '/admin/levels/trash'
 */
trash.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: trash.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::trash
 * @see app/Http/Controllers/Admin/LevelsController.php:112
 * @route '/admin/levels/trash'
 */
    const trashForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: trash.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::trash
 * @see app/Http/Controllers/Admin/LevelsController.php:112
 * @route '/admin/levels/trash'
 */
        trashForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: trash.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LevelsController::trash
 * @see app/Http/Controllers/Admin/LevelsController.php:112
 * @route '/admin/levels/trash'
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
* @see \App\Http\Controllers\Admin\LevelsController::emptyTrash
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
export const emptyTrash = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: emptyTrash.url(options),
    method: 'post',
})

emptyTrash.definition = {
    methods: ["post"],
    url: '/admin/levels/trash/empty',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::emptyTrash
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
emptyTrash.url = (options?: RouteQueryOptions) => {
    return emptyTrash.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::emptyTrash
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
emptyTrash.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: emptyTrash.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::emptyTrash
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
    const emptyTrashForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: emptyTrash.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::emptyTrash
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
        emptyTrashForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: emptyTrash.url(options),
            method: 'post',
        })
    
    emptyTrash.form = emptyTrashForm
/**
* @see \App\Http\Controllers\Admin\LevelsController::restore
 * @see app/Http/Controllers/Admin/LevelsController.php:124
 * @route '/admin/levels/{level}/restore'
 */
export const restore = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: restore.url(args, options),
    method: 'post',
})

restore.definition = {
    methods: ["post"],
    url: '/admin/levels/{level}/restore',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::restore
 * @see app/Http/Controllers/Admin/LevelsController.php:124
 * @route '/admin/levels/{level}/restore'
 */
restore.url = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { level: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    level: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        level: args.level,
                }

    return restore.definition.url
            .replace('{level}', parsedArgs.level.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::restore
 * @see app/Http/Controllers/Admin/LevelsController.php:124
 * @route '/admin/levels/{level}/restore'
 */
restore.post = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: restore.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::restore
 * @see app/Http/Controllers/Admin/LevelsController.php:124
 * @route '/admin/levels/{level}/restore'
 */
    const restoreForm = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: restore.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::restore
 * @see app/Http/Controllers/Admin/LevelsController.php:124
 * @route '/admin/levels/{level}/restore'
 */
        restoreForm.post = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: restore.url(args, options),
            method: 'post',
        })
    
    restore.form = restoreForm
/**
* @see \App\Http\Controllers\Admin\LevelsController::forceDelete
 * @see app/Http/Controllers/Admin/LevelsController.php:136
 * @route '/admin/levels/{level}/force-delete'
 */
export const forceDelete = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

forceDelete.definition = {
    methods: ["delete"],
    url: '/admin/levels/{level}/force-delete',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::forceDelete
 * @see app/Http/Controllers/Admin/LevelsController.php:136
 * @route '/admin/levels/{level}/force-delete'
 */
forceDelete.url = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { level: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    level: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        level: args.level,
                }

    return forceDelete.definition.url
            .replace('{level}', parsedArgs.level.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::forceDelete
 * @see app/Http/Controllers/Admin/LevelsController.php:136
 * @route '/admin/levels/{level}/force-delete'
 */
forceDelete.delete = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::forceDelete
 * @see app/Http/Controllers/Admin/LevelsController.php:136
 * @route '/admin/levels/{level}/force-delete'
 */
    const forceDeleteForm = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: forceDelete.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::forceDelete
 * @see app/Http/Controllers/Admin/LevelsController.php:136
 * @route '/admin/levels/{level}/force-delete'
 */
        forceDeleteForm.delete = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\LevelsController::show
 * @see app/Http/Controllers/Admin/LevelsController.php:65
 * @route '/admin/levels/{level}'
 */
export const show = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/levels/{level}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::show
 * @see app/Http/Controllers/Admin/LevelsController.php:65
 * @route '/admin/levels/{level}'
 */
show.url = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { level: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { level: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    level: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        level: typeof args.level === 'object'
                ? args.level.id
                : args.level,
                }

    return show.definition.url
            .replace('{level}', parsedArgs.level.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::show
 * @see app/Http/Controllers/Admin/LevelsController.php:65
 * @route '/admin/levels/{level}'
 */
show.get = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LevelsController::show
 * @see app/Http/Controllers/Admin/LevelsController.php:65
 * @route '/admin/levels/{level}'
 */
show.head = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::show
 * @see app/Http/Controllers/Admin/LevelsController.php:65
 * @route '/admin/levels/{level}'
 */
    const showForm = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::show
 * @see app/Http/Controllers/Admin/LevelsController.php:65
 * @route '/admin/levels/{level}'
 */
        showForm.get = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LevelsController::show
 * @see app/Http/Controllers/Admin/LevelsController.php:65
 * @route '/admin/levels/{level}'
 */
        showForm.head = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\LevelsController::edit
 * @see app/Http/Controllers/Admin/LevelsController.php:73
 * @route '/admin/levels/{level}/edit'
 */
export const edit = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/levels/{level}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::edit
 * @see app/Http/Controllers/Admin/LevelsController.php:73
 * @route '/admin/levels/{level}/edit'
 */
edit.url = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { level: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { level: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    level: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        level: typeof args.level === 'object'
                ? args.level.id
                : args.level,
                }

    return edit.definition.url
            .replace('{level}', parsedArgs.level.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::edit
 * @see app/Http/Controllers/Admin/LevelsController.php:73
 * @route '/admin/levels/{level}/edit'
 */
edit.get = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LevelsController::edit
 * @see app/Http/Controllers/Admin/LevelsController.php:73
 * @route '/admin/levels/{level}/edit'
 */
edit.head = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::edit
 * @see app/Http/Controllers/Admin/LevelsController.php:73
 * @route '/admin/levels/{level}/edit'
 */
    const editForm = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::edit
 * @see app/Http/Controllers/Admin/LevelsController.php:73
 * @route '/admin/levels/{level}/edit'
 */
        editForm.get = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LevelsController::edit
 * @see app/Http/Controllers/Admin/LevelsController.php:73
 * @route '/admin/levels/{level}/edit'
 */
        editForm.head = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\LevelsController::update
 * @see app/Http/Controllers/Admin/LevelsController.php:81
 * @route '/admin/levels/{level}'
 */
export const update = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/levels/{level}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::update
 * @see app/Http/Controllers/Admin/LevelsController.php:81
 * @route '/admin/levels/{level}'
 */
update.url = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { level: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { level: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    level: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        level: typeof args.level === 'object'
                ? args.level.id
                : args.level,
                }

    return update.definition.url
            .replace('{level}', parsedArgs.level.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::update
 * @see app/Http/Controllers/Admin/LevelsController.php:81
 * @route '/admin/levels/{level}'
 */
update.put = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::update
 * @see app/Http/Controllers/Admin/LevelsController.php:81
 * @route '/admin/levels/{level}'
 */
    const updateForm = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::update
 * @see app/Http/Controllers/Admin/LevelsController.php:81
 * @route '/admin/levels/{level}'
 */
        updateForm.put = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\LevelsController::destroy
 * @see app/Http/Controllers/Admin/LevelsController.php:159
 * @route '/admin/levels/{level}'
 */
export const destroy = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/levels/{level}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::destroy
 * @see app/Http/Controllers/Admin/LevelsController.php:159
 * @route '/admin/levels/{level}'
 */
destroy.url = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { level: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { level: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    level: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        level: typeof args.level === 'object'
                ? args.level.id
                : args.level,
                }

    return destroy.definition.url
            .replace('{level}', parsedArgs.level.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::destroy
 * @see app/Http/Controllers/Admin/LevelsController.php:159
 * @route '/admin/levels/{level}'
 */
destroy.delete = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::destroy
 * @see app/Http/Controllers/Admin/LevelsController.php:159
 * @route '/admin/levels/{level}'
 */
    const destroyForm = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::destroy
 * @see app/Http/Controllers/Admin/LevelsController.php:159
 * @route '/admin/levels/{level}'
 */
        destroyForm.delete = (args: { level: string | number | { id: string | number } } | [level: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\LevelsController::toggleStatus
 * @see app/Http/Controllers/Admin/LevelsController.php:181
 * @route '/admin/levels/{level}/toggle-status'
 */
export const toggleStatus = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: toggleStatus.url(args, options),
    method: 'get',
})

toggleStatus.definition = {
    methods: ["get","head"],
    url: '/admin/levels/{level}/toggle-status',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::toggleStatus
 * @see app/Http/Controllers/Admin/LevelsController.php:181
 * @route '/admin/levels/{level}/toggle-status'
 */
toggleStatus.url = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { level: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    level: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        level: args.level,
                }

    return toggleStatus.definition.url
            .replace('{level}', parsedArgs.level.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::toggleStatus
 * @see app/Http/Controllers/Admin/LevelsController.php:181
 * @route '/admin/levels/{level}/toggle-status'
 */
toggleStatus.get = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: toggleStatus.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LevelsController::toggleStatus
 * @see app/Http/Controllers/Admin/LevelsController.php:181
 * @route '/admin/levels/{level}/toggle-status'
 */
toggleStatus.head = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: toggleStatus.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::toggleStatus
 * @see app/Http/Controllers/Admin/LevelsController.php:181
 * @route '/admin/levels/{level}/toggle-status'
 */
    const toggleStatusForm = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: toggleStatus.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::toggleStatus
 * @see app/Http/Controllers/Admin/LevelsController.php:181
 * @route '/admin/levels/{level}/toggle-status'
 */
        toggleStatusForm.get = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: toggleStatus.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LevelsController::toggleStatus
 * @see app/Http/Controllers/Admin/LevelsController.php:181
 * @route '/admin/levels/{level}/toggle-status'
 */
        toggleStatusForm.head = (args: { level: string | number } | [level: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: toggleStatus.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    toggleStatus.form = toggleStatusForm
const LevelsController = { index, create, store, trash, emptyTrash, restore, forceDelete, show, edit, update, destroy, toggleStatus }

export default LevelsController