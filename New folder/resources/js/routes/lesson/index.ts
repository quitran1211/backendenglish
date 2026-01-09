import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\LessonsController::index
 * @see app/Http/Controllers/Admin/LessonsController.php:20
 * @route '/admin/lesson'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/lesson',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::index
 * @see app/Http/Controllers/Admin/LessonsController.php:20
 * @route '/admin/lesson'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::index
 * @see app/Http/Controllers/Admin/LessonsController.php:20
 * @route '/admin/lesson'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::index
 * @see app/Http/Controllers/Admin/LessonsController.php:20
 * @route '/admin/lesson'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::index
 * @see app/Http/Controllers/Admin/LessonsController.php:20
 * @route '/admin/lesson'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::index
 * @see app/Http/Controllers/Admin/LessonsController.php:20
 * @route '/admin/lesson'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::index
 * @see app/Http/Controllers/Admin/LessonsController.php:20
 * @route '/admin/lesson'
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
* @see \App\Http\Controllers\Admin\LessonsController::trash
 * @see app/Http/Controllers/Admin/LessonsController.php:135
 * @route '/admin/lesson/trash'
 */
export const trash = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})

trash.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/trash',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::trash
 * @see app/Http/Controllers/Admin/LessonsController.php:135
 * @route '/admin/lesson/trash'
 */
trash.url = (options?: RouteQueryOptions) => {
    return trash.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::trash
 * @see app/Http/Controllers/Admin/LessonsController.php:135
 * @route '/admin/lesson/trash'
 */
trash.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::trash
 * @see app/Http/Controllers/Admin/LessonsController.php:135
 * @route '/admin/lesson/trash'
 */
trash.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: trash.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::trash
 * @see app/Http/Controllers/Admin/LessonsController.php:135
 * @route '/admin/lesson/trash'
 */
    const trashForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: trash.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::trash
 * @see app/Http/Controllers/Admin/LessonsController.php:135
 * @route '/admin/lesson/trash'
 */
        trashForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: trash.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::trash
 * @see app/Http/Controllers/Admin/LessonsController.php:135
 * @route '/admin/lesson/trash'
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
* @see \App\Http\Controllers\Admin\LessonsController::destroy
 * @see app/Http/Controllers/Admin/LessonsController.php:159
 * @route '/admin/lesson/{lesson}'
 */
export const destroy = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/lesson/{lesson}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::destroy
 * @see app/Http/Controllers/Admin/LessonsController.php:159
 * @route '/admin/lesson/{lesson}'
 */
destroy.url = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { lesson: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: typeof args.lesson === 'object'
                ? args.lesson.id
                : args.lesson,
                }

    return destroy.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::destroy
 * @see app/Http/Controllers/Admin/LessonsController.php:159
 * @route '/admin/lesson/{lesson}'
 */
destroy.delete = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::destroy
 * @see app/Http/Controllers/Admin/LessonsController.php:159
 * @route '/admin/lesson/{lesson}'
 */
    const destroyForm = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::destroy
 * @see app/Http/Controllers/Admin/LessonsController.php:159
 * @route '/admin/lesson/{lesson}'
 */
        destroyForm.delete = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\LessonsController::deleteMethod
 * @see app/Http/Controllers/Admin/LessonsController.php:176
 * @route '/admin/lesson/{lesson}/delete'
 */
export const deleteMethod = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: deleteMethod.url(args, options),
    method: 'get',
})

deleteMethod.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/{lesson}/delete',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::deleteMethod
 * @see app/Http/Controllers/Admin/LessonsController.php:176
 * @route '/admin/lesson/{lesson}/delete'
 */
deleteMethod.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return deleteMethod.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::deleteMethod
 * @see app/Http/Controllers/Admin/LessonsController.php:176
 * @route '/admin/lesson/{lesson}/delete'
 */
deleteMethod.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: deleteMethod.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::deleteMethod
 * @see app/Http/Controllers/Admin/LessonsController.php:176
 * @route '/admin/lesson/{lesson}/delete'
 */
deleteMethod.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: deleteMethod.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::deleteMethod
 * @see app/Http/Controllers/Admin/LessonsController.php:176
 * @route '/admin/lesson/{lesson}/delete'
 */
    const deleteMethodForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: deleteMethod.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::deleteMethod
 * @see app/Http/Controllers/Admin/LessonsController.php:176
 * @route '/admin/lesson/{lesson}/delete'
 */
        deleteMethodForm.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: deleteMethod.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::deleteMethod
 * @see app/Http/Controllers/Admin/LessonsController.php:176
 * @route '/admin/lesson/{lesson}/delete'
 */
        deleteMethodForm.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\LessonsController::restore
 * @see app/Http/Controllers/Admin/LessonsController.php:148
 * @route '/admin/lesson/{lesson}/restore'
 */
export const restore = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: restore.url(args, options),
    method: 'get',
})

restore.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/{lesson}/restore',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::restore
 * @see app/Http/Controllers/Admin/LessonsController.php:148
 * @route '/admin/lesson/{lesson}/restore'
 */
restore.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return restore.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::restore
 * @see app/Http/Controllers/Admin/LessonsController.php:148
 * @route '/admin/lesson/{lesson}/restore'
 */
restore.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: restore.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::restore
 * @see app/Http/Controllers/Admin/LessonsController.php:148
 * @route '/admin/lesson/{lesson}/restore'
 */
restore.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: restore.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::restore
 * @see app/Http/Controllers/Admin/LessonsController.php:148
 * @route '/admin/lesson/{lesson}/restore'
 */
    const restoreForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: restore.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::restore
 * @see app/Http/Controllers/Admin/LessonsController.php:148
 * @route '/admin/lesson/{lesson}/restore'
 */
        restoreForm.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: restore.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::restore
 * @see app/Http/Controllers/Admin/LessonsController.php:148
 * @route '/admin/lesson/{lesson}/restore'
 */
        restoreForm.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\LessonsController::forceDelete
 * @see app/Http/Controllers/Admin/LessonsController.php:166
 * @route '/admin/lesson/{id}/force-delete'
 */
export const forceDelete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

forceDelete.definition = {
    methods: ["delete"],
    url: '/admin/lesson/{id}/force-delete',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::forceDelete
 * @see app/Http/Controllers/Admin/LessonsController.php:166
 * @route '/admin/lesson/{id}/force-delete'
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
* @see \App\Http\Controllers\Admin\LessonsController::forceDelete
 * @see app/Http/Controllers/Admin/LessonsController.php:166
 * @route '/admin/lesson/{id}/force-delete'
 */
forceDelete.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::forceDelete
 * @see app/Http/Controllers/Admin/LessonsController.php:166
 * @route '/admin/lesson/{id}/force-delete'
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
* @see \App\Http\Controllers\Admin\LessonsController::forceDelete
 * @see app/Http/Controllers/Admin/LessonsController.php:166
 * @route '/admin/lesson/{id}/force-delete'
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
/**
* @see \App\Http\Controllers\Admin\LessonsController::toggleStatus
 * @see app/Http/Controllers/Admin/LessonsController.php:187
 * @route '/admin/lesson/{lesson}/toggle-status'
 */
export const toggleStatus = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: toggleStatus.url(args, options),
    method: 'get',
})

toggleStatus.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/{lesson}/toggle-status',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::toggleStatus
 * @see app/Http/Controllers/Admin/LessonsController.php:187
 * @route '/admin/lesson/{lesson}/toggle-status'
 */
toggleStatus.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return toggleStatus.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::toggleStatus
 * @see app/Http/Controllers/Admin/LessonsController.php:187
 * @route '/admin/lesson/{lesson}/toggle-status'
 */
toggleStatus.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: toggleStatus.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::toggleStatus
 * @see app/Http/Controllers/Admin/LessonsController.php:187
 * @route '/admin/lesson/{lesson}/toggle-status'
 */
toggleStatus.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: toggleStatus.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::toggleStatus
 * @see app/Http/Controllers/Admin/LessonsController.php:187
 * @route '/admin/lesson/{lesson}/toggle-status'
 */
    const toggleStatusForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: toggleStatus.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::toggleStatus
 * @see app/Http/Controllers/Admin/LessonsController.php:187
 * @route '/admin/lesson/{lesson}/toggle-status'
 */
        toggleStatusForm.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: toggleStatus.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::toggleStatus
 * @see app/Http/Controllers/Admin/LessonsController.php:187
 * @route '/admin/lesson/{lesson}/toggle-status'
 */
        toggleStatusForm.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\LessonsController::toggleFree
 * @see app/Http/Controllers/Admin/LessonsController.php:201
 * @route '/admin/lesson/{lesson}/toggle-free'
 */
export const toggleFree = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: toggleFree.url(args, options),
    method: 'get',
})

toggleFree.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/{lesson}/toggle-free',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::toggleFree
 * @see app/Http/Controllers/Admin/LessonsController.php:201
 * @route '/admin/lesson/{lesson}/toggle-free'
 */
toggleFree.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return toggleFree.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::toggleFree
 * @see app/Http/Controllers/Admin/LessonsController.php:201
 * @route '/admin/lesson/{lesson}/toggle-free'
 */
toggleFree.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: toggleFree.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::toggleFree
 * @see app/Http/Controllers/Admin/LessonsController.php:201
 * @route '/admin/lesson/{lesson}/toggle-free'
 */
toggleFree.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: toggleFree.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::toggleFree
 * @see app/Http/Controllers/Admin/LessonsController.php:201
 * @route '/admin/lesson/{lesson}/toggle-free'
 */
    const toggleFreeForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: toggleFree.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::toggleFree
 * @see app/Http/Controllers/Admin/LessonsController.php:201
 * @route '/admin/lesson/{lesson}/toggle-free'
 */
        toggleFreeForm.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: toggleFree.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::toggleFree
 * @see app/Http/Controllers/Admin/LessonsController.php:201
 * @route '/admin/lesson/{lesson}/toggle-free'
 */
        toggleFreeForm.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: toggleFree.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    toggleFree.form = toggleFreeForm
/**
* @see \App\Http\Controllers\Admin\LessonsController::manageVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:233
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
export const manageVocabularies = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: manageVocabularies.url(args, options),
    method: 'get',
})

manageVocabularies.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/{lesson}/vocabularies',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::manageVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:233
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
manageVocabularies.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return manageVocabularies.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::manageVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:233
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
manageVocabularies.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: manageVocabularies.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::manageVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:233
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
manageVocabularies.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: manageVocabularies.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::manageVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:233
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
    const manageVocabulariesForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: manageVocabularies.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::manageVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:233
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
        manageVocabulariesForm.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: manageVocabularies.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::manageVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:233
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
        manageVocabulariesForm.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: manageVocabularies.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    manageVocabularies.form = manageVocabulariesForm
/**
* @see \App\Http\Controllers\Admin\LessonsController::addVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:248
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
export const addVocabularies = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: addVocabularies.url(args, options),
    method: 'post',
})

addVocabularies.definition = {
    methods: ["post"],
    url: '/admin/lesson/{lesson}/vocabularies',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::addVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:248
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
addVocabularies.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return addVocabularies.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::addVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:248
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
addVocabularies.post = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: addVocabularies.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::addVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:248
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
    const addVocabulariesForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: addVocabularies.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::addVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:248
 * @route '/admin/lesson/{lesson}/vocabularies'
 */
        addVocabulariesForm.post = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: addVocabularies.url(args, options),
            method: 'post',
        })
    
    addVocabularies.form = addVocabulariesForm
/**
* @see \App\Http\Controllers\Admin\LessonsController::removeVocabulary
 * @see app/Http/Controllers/Admin/LessonsController.php:434
 * @route '/admin/lesson/{lesson}/vocabularies/{vocabulary}'
 */
export const removeVocabulary = (args: { lesson: string | number, vocabulary: string | number } | [lesson: string | number, vocabulary: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: removeVocabulary.url(args, options),
    method: 'delete',
})

removeVocabulary.definition = {
    methods: ["delete"],
    url: '/admin/lesson/{lesson}/vocabularies/{vocabulary}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::removeVocabulary
 * @see app/Http/Controllers/Admin/LessonsController.php:434
 * @route '/admin/lesson/{lesson}/vocabularies/{vocabulary}'
 */
removeVocabulary.url = (args: { lesson: string | number, vocabulary: string | number } | [lesson: string | number, vocabulary: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                    vocabulary: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                                vocabulary: args.vocabulary,
                }

    return removeVocabulary.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace('{vocabulary}', parsedArgs.vocabulary.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::removeVocabulary
 * @see app/Http/Controllers/Admin/LessonsController.php:434
 * @route '/admin/lesson/{lesson}/vocabularies/{vocabulary}'
 */
removeVocabulary.delete = (args: { lesson: string | number, vocabulary: string | number } | [lesson: string | number, vocabulary: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: removeVocabulary.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::removeVocabulary
 * @see app/Http/Controllers/Admin/LessonsController.php:434
 * @route '/admin/lesson/{lesson}/vocabularies/{vocabulary}'
 */
    const removeVocabularyForm = (args: { lesson: string | number, vocabulary: string | number } | [lesson: string | number, vocabulary: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: removeVocabulary.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::removeVocabulary
 * @see app/Http/Controllers/Admin/LessonsController.php:434
 * @route '/admin/lesson/{lesson}/vocabularies/{vocabulary}'
 */
        removeVocabularyForm.delete = (args: { lesson: string | number, vocabulary: string | number } | [lesson: string | number, vocabulary: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: removeVocabulary.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    removeVocabulary.form = removeVocabularyForm
/**
* @see \App\Http\Controllers\Admin\LessonsController::importVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:337
 * @route '/admin/{lesson}/vocabularies/import'
 */
export const importVocabularies = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importVocabularies.url(args, options),
    method: 'post',
})

importVocabularies.definition = {
    methods: ["post"],
    url: '/admin/{lesson}/vocabularies/import',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::importVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:337
 * @route '/admin/{lesson}/vocabularies/import'
 */
importVocabularies.url = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { lesson: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: typeof args.lesson === 'object'
                ? args.lesson.id
                : args.lesson,
                }

    return importVocabularies.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::importVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:337
 * @route '/admin/{lesson}/vocabularies/import'
 */
importVocabularies.post = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importVocabularies.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::importVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:337
 * @route '/admin/{lesson}/vocabularies/import'
 */
    const importVocabulariesForm = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: importVocabularies.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::importVocabularies
 * @see app/Http/Controllers/Admin/LessonsController.php:337
 * @route '/admin/{lesson}/vocabularies/import'
 */
        importVocabulariesForm.post = (args: { lesson: string | number | { id: string | number } } | [lesson: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: importVocabularies.url(args, options),
            method: 'post',
        })
    
    importVocabularies.form = importVocabulariesForm
/**
* @see \App\Http\Controllers\Admin\LessonsController::create
 * @see app/Http/Controllers/Admin/LessonsController.php:58
 * @route '/admin/lesson/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::create
 * @see app/Http/Controllers/Admin/LessonsController.php:58
 * @route '/admin/lesson/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::create
 * @see app/Http/Controllers/Admin/LessonsController.php:58
 * @route '/admin/lesson/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::create
 * @see app/Http/Controllers/Admin/LessonsController.php:58
 * @route '/admin/lesson/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::create
 * @see app/Http/Controllers/Admin/LessonsController.php:58
 * @route '/admin/lesson/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::create
 * @see app/Http/Controllers/Admin/LessonsController.php:58
 * @route '/admin/lesson/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::create
 * @see app/Http/Controllers/Admin/LessonsController.php:58
 * @route '/admin/lesson/create'
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
* @see \App\Http\Controllers\Admin\LessonsController::store
 * @see app/Http/Controllers/Admin/LessonsController.php:68
 * @route '/admin/lesson'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/lesson',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::store
 * @see app/Http/Controllers/Admin/LessonsController.php:68
 * @route '/admin/lesson'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::store
 * @see app/Http/Controllers/Admin/LessonsController.php:68
 * @route '/admin/lesson'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::store
 * @see app/Http/Controllers/Admin/LessonsController.php:68
 * @route '/admin/lesson'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::store
 * @see app/Http/Controllers/Admin/LessonsController.php:68
 * @route '/admin/lesson'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\LessonsController::show
 * @see app/Http/Controllers/Admin/LessonsController.php:86
 * @route '/admin/lesson/{lesson}'
 */
export const show = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/{lesson}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::show
 * @see app/Http/Controllers/Admin/LessonsController.php:86
 * @route '/admin/lesson/{lesson}'
 */
show.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return show.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::show
 * @see app/Http/Controllers/Admin/LessonsController.php:86
 * @route '/admin/lesson/{lesson}'
 */
show.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::show
 * @see app/Http/Controllers/Admin/LessonsController.php:86
 * @route '/admin/lesson/{lesson}'
 */
show.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::show
 * @see app/Http/Controllers/Admin/LessonsController.php:86
 * @route '/admin/lesson/{lesson}'
 */
    const showForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::show
 * @see app/Http/Controllers/Admin/LessonsController.php:86
 * @route '/admin/lesson/{lesson}'
 */
        showForm.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::show
 * @see app/Http/Controllers/Admin/LessonsController.php:86
 * @route '/admin/lesson/{lesson}'
 */
        showForm.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\LessonsController::edit
 * @see app/Http/Controllers/Admin/LessonsController.php:105
 * @route '/admin/lesson/{lesson}/edit'
 */
export const edit = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/lesson/{lesson}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::edit
 * @see app/Http/Controllers/Admin/LessonsController.php:105
 * @route '/admin/lesson/{lesson}/edit'
 */
edit.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return edit.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::edit
 * @see app/Http/Controllers/Admin/LessonsController.php:105
 * @route '/admin/lesson/{lesson}/edit'
 */
edit.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::edit
 * @see app/Http/Controllers/Admin/LessonsController.php:105
 * @route '/admin/lesson/{lesson}/edit'
 */
edit.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::edit
 * @see app/Http/Controllers/Admin/LessonsController.php:105
 * @route '/admin/lesson/{lesson}/edit'
 */
    const editForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::edit
 * @see app/Http/Controllers/Admin/LessonsController.php:105
 * @route '/admin/lesson/{lesson}/edit'
 */
        editForm.get = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::edit
 * @see app/Http/Controllers/Admin/LessonsController.php:105
 * @route '/admin/lesson/{lesson}/edit'
 */
        editForm.head = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\LessonsController::update
 * @see app/Http/Controllers/Admin/LessonsController.php:116
 * @route '/admin/lesson/{lesson}'
 */
export const update = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/lesson/{lesson}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Admin\LessonsController::update
 * @see app/Http/Controllers/Admin/LessonsController.php:116
 * @route '/admin/lesson/{lesson}'
 */
update.url = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lesson: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    lesson: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        lesson: args.lesson,
                }

    return update.definition.url
            .replace('{lesson}', parsedArgs.lesson.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LessonsController::update
 * @see app/Http/Controllers/Admin/LessonsController.php:116
 * @route '/admin/lesson/{lesson}'
 */
update.put = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\Admin\LessonsController::update
 * @see app/Http/Controllers/Admin/LessonsController.php:116
 * @route '/admin/lesson/{lesson}'
 */
update.patch = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\LessonsController::update
 * @see app/Http/Controllers/Admin/LessonsController.php:116
 * @route '/admin/lesson/{lesson}'
 */
    const updateForm = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LessonsController::update
 * @see app/Http/Controllers/Admin/LessonsController.php:116
 * @route '/admin/lesson/{lesson}'
 */
        updateForm.put = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \App\Http\Controllers\Admin\LessonsController::update
 * @see app/Http/Controllers/Admin/LessonsController.php:116
 * @route '/admin/lesson/{lesson}'
 */
        updateForm.patch = (args: { lesson: string | number } | [lesson: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
const lesson = {
    index: Object.assign(index, index),
trash: Object.assign(trash, trash),
destroy: Object.assign(destroy, destroy),
delete: Object.assign(deleteMethod, deleteMethod),
restore: Object.assign(restore, restore),
forceDelete: Object.assign(forceDelete, forceDelete),
toggleStatus: Object.assign(toggleStatus, toggleStatus),
toggleFree: Object.assign(toggleFree, toggleFree),
manageVocabularies: Object.assign(manageVocabularies, manageVocabularies),
addVocabularies: Object.assign(addVocabularies, addVocabularies),
removeVocabulary: Object.assign(removeVocabulary, removeVocabulary),
importVocabularies: Object.assign(importVocabularies, importVocabularies),
create: Object.assign(create, create),
store: Object.assign(store, store),
show: Object.assign(show, show),
edit: Object.assign(edit, edit),
update: Object.assign(update, update),
}

export default lesson