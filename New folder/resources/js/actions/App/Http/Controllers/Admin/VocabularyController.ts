import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\VocabularyController::index
 * @see app/Http/Controllers/Admin/VocabularyController.php:18
 * @route '/admin/vocabularies'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/vocabularies',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::index
 * @see app/Http/Controllers/Admin/VocabularyController.php:18
 * @route '/admin/vocabularies'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::index
 * @see app/Http/Controllers/Admin/VocabularyController.php:18
 * @route '/admin/vocabularies'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\VocabularyController::index
 * @see app/Http/Controllers/Admin/VocabularyController.php:18
 * @route '/admin/vocabularies'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::index
 * @see app/Http/Controllers/Admin/VocabularyController.php:18
 * @route '/admin/vocabularies'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::index
 * @see app/Http/Controllers/Admin/VocabularyController.php:18
 * @route '/admin/vocabularies'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\VocabularyController::index
 * @see app/Http/Controllers/Admin/VocabularyController.php:18
 * @route '/admin/vocabularies'
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
* @see \App\Http\Controllers\Admin\VocabularyController::create
 * @see app/Http/Controllers/Admin/VocabularyController.php:52
 * @route '/admin/vocabularies/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/vocabularies/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::create
 * @see app/Http/Controllers/Admin/VocabularyController.php:52
 * @route '/admin/vocabularies/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::create
 * @see app/Http/Controllers/Admin/VocabularyController.php:52
 * @route '/admin/vocabularies/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\VocabularyController::create
 * @see app/Http/Controllers/Admin/VocabularyController.php:52
 * @route '/admin/vocabularies/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::create
 * @see app/Http/Controllers/Admin/VocabularyController.php:52
 * @route '/admin/vocabularies/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::create
 * @see app/Http/Controllers/Admin/VocabularyController.php:52
 * @route '/admin/vocabularies/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\VocabularyController::create
 * @see app/Http/Controllers/Admin/VocabularyController.php:52
 * @route '/admin/vocabularies/create'
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
* @see \App\Http\Controllers\Admin\VocabularyController::store
 * @see app/Http/Controllers/Admin/VocabularyController.php:62
 * @route '/admin/vocabularies'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/vocabularies',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::store
 * @see app/Http/Controllers/Admin/VocabularyController.php:62
 * @route '/admin/vocabularies'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::store
 * @see app/Http/Controllers/Admin/VocabularyController.php:62
 * @route '/admin/vocabularies'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::store
 * @see app/Http/Controllers/Admin/VocabularyController.php:62
 * @route '/admin/vocabularies'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::store
 * @see app/Http/Controllers/Admin/VocabularyController.php:62
 * @route '/admin/vocabularies'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\VocabularyController::showImportForm
 * @see app/Http/Controllers/Admin/VocabularyController.php:42
 * @route '/admin/vocabularies/importExcel'
 */
export const showImportForm = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: showImportForm.url(options),
    method: 'get',
})

showImportForm.definition = {
    methods: ["get","head"],
    url: '/admin/vocabularies/importExcel',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::showImportForm
 * @see app/Http/Controllers/Admin/VocabularyController.php:42
 * @route '/admin/vocabularies/importExcel'
 */
showImportForm.url = (options?: RouteQueryOptions) => {
    return showImportForm.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::showImportForm
 * @see app/Http/Controllers/Admin/VocabularyController.php:42
 * @route '/admin/vocabularies/importExcel'
 */
showImportForm.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: showImportForm.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\VocabularyController::showImportForm
 * @see app/Http/Controllers/Admin/VocabularyController.php:42
 * @route '/admin/vocabularies/importExcel'
 */
showImportForm.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: showImportForm.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::showImportForm
 * @see app/Http/Controllers/Admin/VocabularyController.php:42
 * @route '/admin/vocabularies/importExcel'
 */
    const showImportFormForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: showImportForm.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::showImportForm
 * @see app/Http/Controllers/Admin/VocabularyController.php:42
 * @route '/admin/vocabularies/importExcel'
 */
        showImportFormForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: showImportForm.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\VocabularyController::showImportForm
 * @see app/Http/Controllers/Admin/VocabularyController.php:42
 * @route '/admin/vocabularies/importExcel'
 */
        showImportFormForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: showImportForm.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    showImportForm.form = showImportFormForm
/**
* @see \App\Http\Controllers\Admin\VocabularyController::importMethod
 * @see app/Http/Controllers/Admin/VocabularyController.php:201
 * @route '/admin/vocabularies/import'
 */
export const importMethod = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importMethod.url(options),
    method: 'post',
})

importMethod.definition = {
    methods: ["post"],
    url: '/admin/vocabularies/import',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::importMethod
 * @see app/Http/Controllers/Admin/VocabularyController.php:201
 * @route '/admin/vocabularies/import'
 */
importMethod.url = (options?: RouteQueryOptions) => {
    return importMethod.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::importMethod
 * @see app/Http/Controllers/Admin/VocabularyController.php:201
 * @route '/admin/vocabularies/import'
 */
importMethod.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importMethod.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::importMethod
 * @see app/Http/Controllers/Admin/VocabularyController.php:201
 * @route '/admin/vocabularies/import'
 */
    const importMethodForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: importMethod.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::importMethod
 * @see app/Http/Controllers/Admin/VocabularyController.php:201
 * @route '/admin/vocabularies/import'
 */
        importMethodForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: importMethod.url(options),
            method: 'post',
        })
    
    importMethod.form = importMethodForm
/**
* @see \App\Http\Controllers\Admin\VocabularyController::trash
 * @see app/Http/Controllers/Admin/VocabularyController.php:317
 * @route '/admin/vocabularies/trash'
 */
export const trash = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})

trash.definition = {
    methods: ["get","head"],
    url: '/admin/vocabularies/trash',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::trash
 * @see app/Http/Controllers/Admin/VocabularyController.php:317
 * @route '/admin/vocabularies/trash'
 */
trash.url = (options?: RouteQueryOptions) => {
    return trash.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::trash
 * @see app/Http/Controllers/Admin/VocabularyController.php:317
 * @route '/admin/vocabularies/trash'
 */
trash.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: trash.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\VocabularyController::trash
 * @see app/Http/Controllers/Admin/VocabularyController.php:317
 * @route '/admin/vocabularies/trash'
 */
trash.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: trash.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::trash
 * @see app/Http/Controllers/Admin/VocabularyController.php:317
 * @route '/admin/vocabularies/trash'
 */
    const trashForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: trash.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::trash
 * @see app/Http/Controllers/Admin/VocabularyController.php:317
 * @route '/admin/vocabularies/trash'
 */
        trashForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: trash.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\VocabularyController::trash
 * @see app/Http/Controllers/Admin/VocabularyController.php:317
 * @route '/admin/vocabularies/trash'
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
* @see \App\Http\Controllers\Admin\VocabularyController::restore
 * @see app/Http/Controllers/Admin/VocabularyController.php:331
 * @route '/admin/vocabularies/{id}/restore'
 */
export const restore = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: restore.url(args, options),
    method: 'patch',
})

restore.definition = {
    methods: ["patch"],
    url: '/admin/vocabularies/{id}/restore',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::restore
 * @see app/Http/Controllers/Admin/VocabularyController.php:331
 * @route '/admin/vocabularies/{id}/restore'
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
* @see \App\Http\Controllers\Admin\VocabularyController::restore
 * @see app/Http/Controllers/Admin/VocabularyController.php:331
 * @route '/admin/vocabularies/{id}/restore'
 */
restore.patch = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: restore.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::restore
 * @see app/Http/Controllers/Admin/VocabularyController.php:331
 * @route '/admin/vocabularies/{id}/restore'
 */
    const restoreForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: restore.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PATCH',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::restore
 * @see app/Http/Controllers/Admin/VocabularyController.php:331
 * @route '/admin/vocabularies/{id}/restore'
 */
        restoreForm.patch = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: restore.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    restore.form = restoreForm
/**
* @see \App\Http\Controllers\Admin\VocabularyController::forceDelete
 * @see app/Http/Controllers/Admin/VocabularyController.php:345
 * @route '/admin/vocabularies/{id}/force-delete'
 */
export const forceDelete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

forceDelete.definition = {
    methods: ["delete"],
    url: '/admin/vocabularies/{id}/force-delete',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::forceDelete
 * @see app/Http/Controllers/Admin/VocabularyController.php:345
 * @route '/admin/vocabularies/{id}/force-delete'
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
* @see \App\Http\Controllers\Admin\VocabularyController::forceDelete
 * @see app/Http/Controllers/Admin/VocabularyController.php:345
 * @route '/admin/vocabularies/{id}/force-delete'
 */
forceDelete.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: forceDelete.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::forceDelete
 * @see app/Http/Controllers/Admin/VocabularyController.php:345
 * @route '/admin/vocabularies/{id}/force-delete'
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
* @see \App\Http\Controllers\Admin\VocabularyController::forceDelete
 * @see app/Http/Controllers/Admin/VocabularyController.php:345
 * @route '/admin/vocabularies/{id}/force-delete'
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
* @see \App\Http\Controllers\Admin\VocabularyController::toggleStatus
 * @see app/Http/Controllers/Admin/VocabularyController.php:303
 * @route '/admin/vocabularies/{vocabulary}/toggle-status'
 */
export const toggleStatus = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

toggleStatus.definition = {
    methods: ["patch"],
    url: '/admin/vocabularies/{vocabulary}/toggle-status',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::toggleStatus
 * @see app/Http/Controllers/Admin/VocabularyController.php:303
 * @route '/admin/vocabularies/{vocabulary}/toggle-status'
 */
toggleStatus.url = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { vocabulary: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { vocabulary: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    vocabulary: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        vocabulary: typeof args.vocabulary === 'object'
                ? args.vocabulary.id
                : args.vocabulary,
                }

    return toggleStatus.definition.url
            .replace('{vocabulary}', parsedArgs.vocabulary.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::toggleStatus
 * @see app/Http/Controllers/Admin/VocabularyController.php:303
 * @route '/admin/vocabularies/{vocabulary}/toggle-status'
 */
toggleStatus.patch = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::toggleStatus
 * @see app/Http/Controllers/Admin/VocabularyController.php:303
 * @route '/admin/vocabularies/{vocabulary}/toggle-status'
 */
    const toggleStatusForm = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: toggleStatus.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PATCH',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::toggleStatus
 * @see app/Http/Controllers/Admin/VocabularyController.php:303
 * @route '/admin/vocabularies/{vocabulary}/toggle-status'
 */
        toggleStatusForm.patch = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: toggleStatus.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    toggleStatus.form = toggleStatusForm
/**
* @see \App\Http\Controllers\Admin\VocabularyController::edit
 * @see app/Http/Controllers/Admin/VocabularyController.php:87
 * @route '/admin/vocabularies/{vocabulary}/edit'
 */
export const edit = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/vocabularies/{vocabulary}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::edit
 * @see app/Http/Controllers/Admin/VocabularyController.php:87
 * @route '/admin/vocabularies/{vocabulary}/edit'
 */
edit.url = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { vocabulary: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { vocabulary: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    vocabulary: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        vocabulary: typeof args.vocabulary === 'object'
                ? args.vocabulary.id
                : args.vocabulary,
                }

    return edit.definition.url
            .replace('{vocabulary}', parsedArgs.vocabulary.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::edit
 * @see app/Http/Controllers/Admin/VocabularyController.php:87
 * @route '/admin/vocabularies/{vocabulary}/edit'
 */
edit.get = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\VocabularyController::edit
 * @see app/Http/Controllers/Admin/VocabularyController.php:87
 * @route '/admin/vocabularies/{vocabulary}/edit'
 */
edit.head = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::edit
 * @see app/Http/Controllers/Admin/VocabularyController.php:87
 * @route '/admin/vocabularies/{vocabulary}/edit'
 */
    const editForm = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::edit
 * @see app/Http/Controllers/Admin/VocabularyController.php:87
 * @route '/admin/vocabularies/{vocabulary}/edit'
 */
        editForm.get = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\VocabularyController::edit
 * @see app/Http/Controllers/Admin/VocabularyController.php:87
 * @route '/admin/vocabularies/{vocabulary}/edit'
 */
        editForm.head = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\VocabularyController::update
 * @see app/Http/Controllers/Admin/VocabularyController.php:97
 * @route '/admin/vocabularies/{vocabulary}'
 */
export const update = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/vocabularies/{vocabulary}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::update
 * @see app/Http/Controllers/Admin/VocabularyController.php:97
 * @route '/admin/vocabularies/{vocabulary}'
 */
update.url = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { vocabulary: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { vocabulary: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    vocabulary: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        vocabulary: typeof args.vocabulary === 'object'
                ? args.vocabulary.id
                : args.vocabulary,
                }

    return update.definition.url
            .replace('{vocabulary}', parsedArgs.vocabulary.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::update
 * @see app/Http/Controllers/Admin/VocabularyController.php:97
 * @route '/admin/vocabularies/{vocabulary}'
 */
update.put = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::update
 * @see app/Http/Controllers/Admin/VocabularyController.php:97
 * @route '/admin/vocabularies/{vocabulary}'
 */
    const updateForm = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::update
 * @see app/Http/Controllers/Admin/VocabularyController.php:97
 * @route '/admin/vocabularies/{vocabulary}'
 */
        updateForm.put = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\VocabularyController::destroy
 * @see app/Http/Controllers/Admin/VocabularyController.php:129
 * @route '/admin/vocabularies/{vocabulary}'
 */
export const destroy = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/vocabularies/{vocabulary}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::destroy
 * @see app/Http/Controllers/Admin/VocabularyController.php:129
 * @route '/admin/vocabularies/{vocabulary}'
 */
destroy.url = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { vocabulary: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { vocabulary: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    vocabulary: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        vocabulary: typeof args.vocabulary === 'object'
                ? args.vocabulary.id
                : args.vocabulary,
                }

    return destroy.definition.url
            .replace('{vocabulary}', parsedArgs.vocabulary.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::destroy
 * @see app/Http/Controllers/Admin/VocabularyController.php:129
 * @route '/admin/vocabularies/{vocabulary}'
 */
destroy.delete = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::destroy
 * @see app/Http/Controllers/Admin/VocabularyController.php:129
 * @route '/admin/vocabularies/{vocabulary}'
 */
    const destroyForm = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::destroy
 * @see app/Http/Controllers/Admin/VocabularyController.php:129
 * @route '/admin/vocabularies/{vocabulary}'
 */
        destroyForm.delete = (args: { vocabulary: string | number | { id: string | number } } | [vocabulary: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\VocabularyController::show
 * @see app/Http/Controllers/Admin/VocabularyController.php:117
 * @route '/admin/vocabularies/{vocabulary}'
 */
export const show = (args: { vocabulary: string | number } | [vocabulary: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/vocabularies/{vocabulary}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\VocabularyController::show
 * @see app/Http/Controllers/Admin/VocabularyController.php:117
 * @route '/admin/vocabularies/{vocabulary}'
 */
show.url = (args: { vocabulary: string | number } | [vocabulary: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { vocabulary: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    vocabulary: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        vocabulary: args.vocabulary,
                }

    return show.definition.url
            .replace('{vocabulary}', parsedArgs.vocabulary.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\VocabularyController::show
 * @see app/Http/Controllers/Admin/VocabularyController.php:117
 * @route '/admin/vocabularies/{vocabulary}'
 */
show.get = (args: { vocabulary: string | number } | [vocabulary: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\VocabularyController::show
 * @see app/Http/Controllers/Admin/VocabularyController.php:117
 * @route '/admin/vocabularies/{vocabulary}'
 */
show.head = (args: { vocabulary: string | number } | [vocabulary: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\VocabularyController::show
 * @see app/Http/Controllers/Admin/VocabularyController.php:117
 * @route '/admin/vocabularies/{vocabulary}'
 */
    const showForm = (args: { vocabulary: string | number } | [vocabulary: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\VocabularyController::show
 * @see app/Http/Controllers/Admin/VocabularyController.php:117
 * @route '/admin/vocabularies/{vocabulary}'
 */
        showForm.get = (args: { vocabulary: string | number } | [vocabulary: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\VocabularyController::show
 * @see app/Http/Controllers/Admin/VocabularyController.php:117
 * @route '/admin/vocabularies/{vocabulary}'
 */
        showForm.head = (args: { vocabulary: string | number } | [vocabulary: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
const VocabularyController = { index, create, store, showImportForm, importMethod, trash, restore, forceDelete, toggleStatus, edit, update, destroy, show, import: importMethod }

export default VocabularyController