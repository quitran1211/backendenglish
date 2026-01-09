import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Api\DictionaryController::search
 * @see app/Http/Controllers/Api/DictionaryController.php:12
 * @route '/api/dictionary'
 */
export const search = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: search.url(options),
    method: 'get',
})

search.definition = {
    methods: ["get","head"],
    url: '/api/dictionary',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Api\DictionaryController::search
 * @see app/Http/Controllers/Api/DictionaryController.php:12
 * @route '/api/dictionary'
 */
search.url = (options?: RouteQueryOptions) => {
    return search.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Api\DictionaryController::search
 * @see app/Http/Controllers/Api/DictionaryController.php:12
 * @route '/api/dictionary'
 */
search.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: search.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Api\DictionaryController::search
 * @see app/Http/Controllers/Api/DictionaryController.php:12
 * @route '/api/dictionary'
 */
search.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: search.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Api\DictionaryController::search
 * @see app/Http/Controllers/Api/DictionaryController.php:12
 * @route '/api/dictionary'
 */
    const searchForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: search.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Api\DictionaryController::search
 * @see app/Http/Controllers/Api/DictionaryController.php:12
 * @route '/api/dictionary'
 */
        searchForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: search.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Api\DictionaryController::search
 * @see app/Http/Controllers/Api/DictionaryController.php:12
 * @route '/api/dictionary'
 */
        searchForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: search.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    search.form = searchForm
const DictionaryController = { search }

export default DictionaryController