import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\UsersController::index
 * @see app/Http/Controllers/Admin/UsersController.php:19
 * @route '/admin/users'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/users',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::index
 * @see app/Http/Controllers/Admin/UsersController.php:19
 * @route '/admin/users'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::index
 * @see app/Http/Controllers/Admin/UsersController.php:19
 * @route '/admin/users'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::index
 * @see app/Http/Controllers/Admin/UsersController.php:19
 * @route '/admin/users'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::index
 * @see app/Http/Controllers/Admin/UsersController.php:19
 * @route '/admin/users'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::index
 * @see app/Http/Controllers/Admin/UsersController.php:19
 * @route '/admin/users'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::index
 * @see app/Http/Controllers/Admin/UsersController.php:19
 * @route '/admin/users'
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
* @see \App\Http\Controllers\Admin\UsersController::create
 * @see app/Http/Controllers/Admin/UsersController.php:56
 * @route '/admin/users/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/users/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::create
 * @see app/Http/Controllers/Admin/UsersController.php:56
 * @route '/admin/users/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::create
 * @see app/Http/Controllers/Admin/UsersController.php:56
 * @route '/admin/users/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::create
 * @see app/Http/Controllers/Admin/UsersController.php:56
 * @route '/admin/users/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::create
 * @see app/Http/Controllers/Admin/UsersController.php:56
 * @route '/admin/users/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::create
 * @see app/Http/Controllers/Admin/UsersController.php:56
 * @route '/admin/users/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::create
 * @see app/Http/Controllers/Admin/UsersController.php:56
 * @route '/admin/users/create'
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
* @see \App\Http\Controllers\Admin\UsersController::store
 * @see app/Http/Controllers/Admin/UsersController.php:66
 * @route '/admin/users'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/users',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::store
 * @see app/Http/Controllers/Admin/UsersController.php:66
 * @route '/admin/users'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::store
 * @see app/Http/Controllers/Admin/UsersController.php:66
 * @route '/admin/users'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::store
 * @see app/Http/Controllers/Admin/UsersController.php:66
 * @route '/admin/users'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::store
 * @see app/Http/Controllers/Admin/UsersController.php:66
 * @route '/admin/users'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\UsersController::show
 * @see app/Http/Controllers/Admin/UsersController.php:91
 * @route '/admin/users/{id}'
 */
export const show = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/users/{id}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::show
 * @see app/Http/Controllers/Admin/UsersController.php:91
 * @route '/admin/users/{id}'
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
* @see \App\Http\Controllers\Admin\UsersController::show
 * @see app/Http/Controllers/Admin/UsersController.php:91
 * @route '/admin/users/{id}'
 */
show.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::show
 * @see app/Http/Controllers/Admin/UsersController.php:91
 * @route '/admin/users/{id}'
 */
show.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::show
 * @see app/Http/Controllers/Admin/UsersController.php:91
 * @route '/admin/users/{id}'
 */
    const showForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::show
 * @see app/Http/Controllers/Admin/UsersController.php:91
 * @route '/admin/users/{id}'
 */
        showForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::show
 * @see app/Http/Controllers/Admin/UsersController.php:91
 * @route '/admin/users/{id}'
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
* @see \App\Http\Controllers\Admin\UsersController::edit
 * @see app/Http/Controllers/Admin/UsersController.php:101
 * @route '/admin/users/{id}/edit'
 */
export const edit = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/users/{id}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::edit
 * @see app/Http/Controllers/Admin/UsersController.php:101
 * @route '/admin/users/{id}/edit'
 */
edit.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return edit.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::edit
 * @see app/Http/Controllers/Admin/UsersController.php:101
 * @route '/admin/users/{id}/edit'
 */
edit.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::edit
 * @see app/Http/Controllers/Admin/UsersController.php:101
 * @route '/admin/users/{id}/edit'
 */
edit.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::edit
 * @see app/Http/Controllers/Admin/UsersController.php:101
 * @route '/admin/users/{id}/edit'
 */
    const editForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::edit
 * @see app/Http/Controllers/Admin/UsersController.php:101
 * @route '/admin/users/{id}/edit'
 */
        editForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::edit
 * @see app/Http/Controllers/Admin/UsersController.php:101
 * @route '/admin/users/{id}/edit'
 */
        editForm.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\UsersController::update
 * @see app/Http/Controllers/Admin/UsersController.php:112
 * @route '/admin/users/{id}'
 */
export const update = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/users/{id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::update
 * @see app/Http/Controllers/Admin/UsersController.php:112
 * @route '/admin/users/{id}'
 */
update.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return update.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::update
 * @see app/Http/Controllers/Admin/UsersController.php:112
 * @route '/admin/users/{id}'
 */
update.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::update
 * @see app/Http/Controllers/Admin/UsersController.php:112
 * @route '/admin/users/{id}'
 */
    const updateForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::update
 * @see app/Http/Controllers/Admin/UsersController.php:112
 * @route '/admin/users/{id}'
 */
        updateForm.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\UsersController::deleteMethod
 * @see app/Http/Controllers/Admin/UsersController.php:147
 * @route '/admin/users/{id}'
 */
export const deleteMethod = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

deleteMethod.definition = {
    methods: ["delete"],
    url: '/admin/users/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::deleteMethod
 * @see app/Http/Controllers/Admin/UsersController.php:147
 * @route '/admin/users/{id}'
 */
deleteMethod.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return deleteMethod.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::deleteMethod
 * @see app/Http/Controllers/Admin/UsersController.php:147
 * @route '/admin/users/{id}'
 */
deleteMethod.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::deleteMethod
 * @see app/Http/Controllers/Admin/UsersController.php:147
 * @route '/admin/users/{id}'
 */
    const deleteMethodForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: deleteMethod.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::deleteMethod
 * @see app/Http/Controllers/Admin/UsersController.php:147
 * @route '/admin/users/{id}'
 */
        deleteMethodForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: deleteMethod.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    deleteMethod.form = deleteMethodForm
/**
* @see \App\Http\Controllers\Admin\UsersController::togglePremium
 * @see app/Http/Controllers/Admin/UsersController.php:205
 * @route '/admin/users/{id}/toggle-premium'
 */
export const togglePremium = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: togglePremium.url(args, options),
    method: 'get',
})

togglePremium.definition = {
    methods: ["get","head"],
    url: '/admin/users/{id}/toggle-premium',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::togglePremium
 * @see app/Http/Controllers/Admin/UsersController.php:205
 * @route '/admin/users/{id}/toggle-premium'
 */
togglePremium.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return togglePremium.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::togglePremium
 * @see app/Http/Controllers/Admin/UsersController.php:205
 * @route '/admin/users/{id}/toggle-premium'
 */
togglePremium.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: togglePremium.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::togglePremium
 * @see app/Http/Controllers/Admin/UsersController.php:205
 * @route '/admin/users/{id}/toggle-premium'
 */
togglePremium.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: togglePremium.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::togglePremium
 * @see app/Http/Controllers/Admin/UsersController.php:205
 * @route '/admin/users/{id}/toggle-premium'
 */
    const togglePremiumForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: togglePremium.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::togglePremium
 * @see app/Http/Controllers/Admin/UsersController.php:205
 * @route '/admin/users/{id}/toggle-premium'
 */
        togglePremiumForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: togglePremium.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::togglePremium
 * @see app/Http/Controllers/Admin/UsersController.php:205
 * @route '/admin/users/{id}/toggle-premium'
 */
        togglePremiumForm.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: togglePremium.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    togglePremium.form = togglePremiumForm
/**
* @see \App\Http\Controllers\Admin\UsersController::changeRole
 * @see app/Http/Controllers/Admin/UsersController.php:219
 * @route '/admin/users/{id}/change-role'
 */
export const changeRole = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: changeRole.url(args, options),
    method: 'post',
})

changeRole.definition = {
    methods: ["post"],
    url: '/admin/users/{id}/change-role',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::changeRole
 * @see app/Http/Controllers/Admin/UsersController.php:219
 * @route '/admin/users/{id}/change-role'
 */
changeRole.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return changeRole.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::changeRole
 * @see app/Http/Controllers/Admin/UsersController.php:219
 * @route '/admin/users/{id}/change-role'
 */
changeRole.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: changeRole.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::changeRole
 * @see app/Http/Controllers/Admin/UsersController.php:219
 * @route '/admin/users/{id}/change-role'
 */
    const changeRoleForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: changeRole.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::changeRole
 * @see app/Http/Controllers/Admin/UsersController.php:219
 * @route '/admin/users/{id}/change-role'
 */
        changeRoleForm.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: changeRole.url(args, options),
            method: 'post',
        })
    
    changeRole.form = changeRoleForm
/**
* @see \App\Http\Controllers\Admin\UsersController::resetPassword
 * @see app/Http/Controllers/Admin/UsersController.php:241
 * @route '/admin/users/{id}/reset-password'
 */
export const resetPassword = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: resetPassword.url(args, options),
    method: 'post',
})

resetPassword.definition = {
    methods: ["post"],
    url: '/admin/users/{id}/reset-password',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::resetPassword
 * @see app/Http/Controllers/Admin/UsersController.php:241
 * @route '/admin/users/{id}/reset-password'
 */
resetPassword.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return resetPassword.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::resetPassword
 * @see app/Http/Controllers/Admin/UsersController.php:241
 * @route '/admin/users/{id}/reset-password'
 */
resetPassword.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: resetPassword.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::resetPassword
 * @see app/Http/Controllers/Admin/UsersController.php:241
 * @route '/admin/users/{id}/reset-password'
 */
    const resetPasswordForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: resetPassword.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::resetPassword
 * @see app/Http/Controllers/Admin/UsersController.php:241
 * @route '/admin/users/{id}/reset-password'
 */
        resetPasswordForm.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: resetPassword.url(args, options),
            method: 'post',
        })
    
    resetPassword.form = resetPasswordForm
/**
* @see \App\Http\Controllers\Admin\UsersController::progress
 * @see app/Http/Controllers/Admin/UsersController.php:257
 * @route '/admin/users/{id}/progress'
 */
export const progress = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: progress.url(args, options),
    method: 'get',
})

progress.definition = {
    methods: ["get","head"],
    url: '/admin/users/{id}/progress',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::progress
 * @see app/Http/Controllers/Admin/UsersController.php:257
 * @route '/admin/users/{id}/progress'
 */
progress.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return progress.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::progress
 * @see app/Http/Controllers/Admin/UsersController.php:257
 * @route '/admin/users/{id}/progress'
 */
progress.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: progress.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::progress
 * @see app/Http/Controllers/Admin/UsersController.php:257
 * @route '/admin/users/{id}/progress'
 */
progress.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: progress.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::progress
 * @see app/Http/Controllers/Admin/UsersController.php:257
 * @route '/admin/users/{id}/progress'
 */
    const progressForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: progress.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::progress
 * @see app/Http/Controllers/Admin/UsersController.php:257
 * @route '/admin/users/{id}/progress'
 */
        progressForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: progress.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::progress
 * @see app/Http/Controllers/Admin/UsersController.php:257
 * @route '/admin/users/{id}/progress'
 */
        progressForm.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: progress.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    progress.form = progressForm
/**
* @see \App\Http\Controllers\Admin\UsersController::achievements
 * @see app/Http/Controllers/Admin/UsersController.php:273
 * @route '/admin/users/{id}/achievements'
 */
export const achievements = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: achievements.url(args, options),
    method: 'get',
})

achievements.definition = {
    methods: ["get","head"],
    url: '/admin/users/{id}/achievements',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::achievements
 * @see app/Http/Controllers/Admin/UsersController.php:273
 * @route '/admin/users/{id}/achievements'
 */
achievements.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return achievements.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::achievements
 * @see app/Http/Controllers/Admin/UsersController.php:273
 * @route '/admin/users/{id}/achievements'
 */
achievements.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: achievements.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::achievements
 * @see app/Http/Controllers/Admin/UsersController.php:273
 * @route '/admin/users/{id}/achievements'
 */
achievements.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: achievements.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::achievements
 * @see app/Http/Controllers/Admin/UsersController.php:273
 * @route '/admin/users/{id}/achievements'
 */
    const achievementsForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: achievements.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::achievements
 * @see app/Http/Controllers/Admin/UsersController.php:273
 * @route '/admin/users/{id}/achievements'
 */
        achievementsForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: achievements.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::achievements
 * @see app/Http/Controllers/Admin/UsersController.php:273
 * @route '/admin/users/{id}/achievements'
 */
        achievementsForm.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: achievements.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    achievements.form = achievementsForm
/**
* @see \App\Http\Controllers\Admin\UsersController::trash
 * @see app/Http/Controllers/Admin/UsersController.php:164
 * @route '/admin/users/trash/list'
 */
export const trash = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})

trash.definition = {
    methods: ["get","head"],
    url: '/admin/users/trash/list',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::trash
 * @see app/Http/Controllers/Admin/UsersController.php:164
 * @route '/admin/users/trash/list'
 */
trash.url = (options?: RouteQueryOptions) => {
    return trash.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::trash
 * @see app/Http/Controllers/Admin/UsersController.php:164
 * @route '/admin/users/trash/list'
 */
trash.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::trash
 * @see app/Http/Controllers/Admin/UsersController.php:164
 * @route '/admin/users/trash/list'
 */
trash.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: trash.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::trash
 * @see app/Http/Controllers/Admin/UsersController.php:164
 * @route '/admin/users/trash/list'
 */
    const trashForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: trash.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::trash
 * @see app/Http/Controllers/Admin/UsersController.php:164
 * @route '/admin/users/trash/list'
 */
        trashForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: trash.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::trash
 * @see app/Http/Controllers/Admin/UsersController.php:164
 * @route '/admin/users/trash/list'
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
* @see \App\Http\Controllers\Admin\UsersController::restore
 * @see app/Http/Controllers/Admin/UsersController.php:177
 * @route '/admin/users/trash/{id}/restore'
 */
export const restore = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: restore.url(args, options),
    method: 'post',
})

restore.definition = {
    methods: ["post"],
    url: '/admin/users/trash/{id}/restore',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::restore
 * @see app/Http/Controllers/Admin/UsersController.php:177
 * @route '/admin/users/trash/{id}/restore'
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
* @see \App\Http\Controllers\Admin\UsersController::restore
 * @see app/Http/Controllers/Admin/UsersController.php:177
 * @route '/admin/users/trash/{id}/restore'
 */
restore.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: restore.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::restore
 * @see app/Http/Controllers/Admin/UsersController.php:177
 * @route '/admin/users/trash/{id}/restore'
 */
    const restoreForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: restore.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::restore
 * @see app/Http/Controllers/Admin/UsersController.php:177
 * @route '/admin/users/trash/{id}/restore'
 */
        restoreForm.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: restore.url(args, options),
            method: 'post',
        })
    
    restore.form = restoreForm
/**
* @see \App\Http\Controllers\Admin\UsersController::destroy
 * @see app/Http/Controllers/Admin/UsersController.php:188
 * @route '/admin/users/trash/{id}'
 */
export const destroy = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/users/trash/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::destroy
 * @see app/Http/Controllers/Admin/UsersController.php:188
 * @route '/admin/users/trash/{id}'
 */
destroy.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::destroy
 * @see app/Http/Controllers/Admin/UsersController.php:188
 * @route '/admin/users/trash/{id}'
 */
destroy.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::destroy
 * @see app/Http/Controllers/Admin/UsersController.php:188
 * @route '/admin/users/trash/{id}'
 */
    const destroyForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::destroy
 * @see app/Http/Controllers/Admin/UsersController.php:188
 * @route '/admin/users/trash/{id}'
 */
        destroyForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\UsersController::bulkAction
 * @see app/Http/Controllers/Admin/UsersController.php:288
 * @route '/admin/users/bulk-action'
 */
export const bulkAction = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkAction.url(options),
    method: 'post',
})

bulkAction.definition = {
    methods: ["post"],
    url: '/admin/users/bulk-action',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::bulkAction
 * @see app/Http/Controllers/Admin/UsersController.php:288
 * @route '/admin/users/bulk-action'
 */
bulkAction.url = (options?: RouteQueryOptions) => {
    return bulkAction.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::bulkAction
 * @see app/Http/Controllers/Admin/UsersController.php:288
 * @route '/admin/users/bulk-action'
 */
bulkAction.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkAction.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::bulkAction
 * @see app/Http/Controllers/Admin/UsersController.php:288
 * @route '/admin/users/bulk-action'
 */
    const bulkActionForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: bulkAction.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::bulkAction
 * @see app/Http/Controllers/Admin/UsersController.php:288
 * @route '/admin/users/bulk-action'
 */
        bulkActionForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: bulkAction.url(options),
            method: 'post',
        })
    
    bulkAction.form = bulkActionForm
/**
* @see \App\Http\Controllers\Admin\UsersController::exportMethod
 * @see app/Http/Controllers/Admin/UsersController.php:329
 * @route '/admin/users/export'
 */
export const exportMethod = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exportMethod.url(options),
    method: 'get',
})

exportMethod.definition = {
    methods: ["get","head"],
    url: '/admin/users/export',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\UsersController::exportMethod
 * @see app/Http/Controllers/Admin/UsersController.php:329
 * @route '/admin/users/export'
 */
exportMethod.url = (options?: RouteQueryOptions) => {
    return exportMethod.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\UsersController::exportMethod
 * @see app/Http/Controllers/Admin/UsersController.php:329
 * @route '/admin/users/export'
 */
exportMethod.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exportMethod.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\UsersController::exportMethod
 * @see app/Http/Controllers/Admin/UsersController.php:329
 * @route '/admin/users/export'
 */
exportMethod.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: exportMethod.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\UsersController::exportMethod
 * @see app/Http/Controllers/Admin/UsersController.php:329
 * @route '/admin/users/export'
 */
    const exportMethodForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: exportMethod.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\UsersController::exportMethod
 * @see app/Http/Controllers/Admin/UsersController.php:329
 * @route '/admin/users/export'
 */
        exportMethodForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: exportMethod.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\UsersController::exportMethod
 * @see app/Http/Controllers/Admin/UsersController.php:329
 * @route '/admin/users/export'
 */
        exportMethodForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: exportMethod.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    exportMethod.form = exportMethodForm
const UsersController = { index, create, store, show, edit, update, deleteMethod, togglePremium, changeRole, resetPassword, progress, achievements, trash, restore, destroy, bulkAction, exportMethod, delete: deleteMethod, export: exportMethod }

export default UsersController