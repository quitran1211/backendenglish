import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\LevelsController::empty
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
export const empty = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: empty.url(options),
    method: 'post',
})

empty.definition = {
    methods: ["post"],
    url: '/admin/levels/trash/empty',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\LevelsController::empty
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
empty.url = (options?: RouteQueryOptions) => {
    return empty.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LevelsController::empty
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
empty.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: empty.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\LevelsController::empty
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
    const emptyForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: empty.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\LevelsController::empty
 * @see app/Http/Controllers/Admin/LevelsController.php:148
 * @route '/admin/levels/trash/empty'
 */
        emptyForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: empty.url(options),
            method: 'post',
        })
    
    empty.form = emptyForm
const trash = {
    empty: Object.assign(empty, empty),
}

export default trash