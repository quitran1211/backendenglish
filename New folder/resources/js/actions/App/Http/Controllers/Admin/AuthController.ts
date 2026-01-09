import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\AuthController::login
 * @see app/Http/Controllers/Admin/AuthController.php:11
 * @route '/admin/login'
 */
export const login = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})

login.definition = {
    methods: ["get","head"],
    url: '/admin/login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AuthController::login
 * @see app/Http/Controllers/Admin/AuthController.php:11
 * @route '/admin/login'
 */
login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AuthController::login
 * @see app/Http/Controllers/Admin/AuthController.php:11
 * @route '/admin/login'
 */
login.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\AuthController::login
 * @see app/Http/Controllers/Admin/AuthController.php:11
 * @route '/admin/login'
 */
login.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: login.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\AuthController::login
 * @see app/Http/Controllers/Admin/AuthController.php:11
 * @route '/admin/login'
 */
    const loginForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: login.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\AuthController::login
 * @see app/Http/Controllers/Admin/AuthController.php:11
 * @route '/admin/login'
 */
        loginForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: login.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\AuthController::login
 * @see app/Http/Controllers/Admin/AuthController.php:11
 * @route '/admin/login'
 */
        loginForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: login.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    login.form = loginForm
/**
* @see \App\Http\Controllers\Admin\AuthController::dologin
 * @see app/Http/Controllers/Admin/AuthController.php:16
 * @route '/admin/login'
 */
export const dologin = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: dologin.url(options),
    method: 'post',
})

dologin.definition = {
    methods: ["post"],
    url: '/admin/login',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\AuthController::dologin
 * @see app/Http/Controllers/Admin/AuthController.php:16
 * @route '/admin/login'
 */
dologin.url = (options?: RouteQueryOptions) => {
    return dologin.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AuthController::dologin
 * @see app/Http/Controllers/Admin/AuthController.php:16
 * @route '/admin/login'
 */
dologin.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: dologin.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\AuthController::dologin
 * @see app/Http/Controllers/Admin/AuthController.php:16
 * @route '/admin/login'
 */
    const dologinForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: dologin.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\AuthController::dologin
 * @see app/Http/Controllers/Admin/AuthController.php:16
 * @route '/admin/login'
 */
        dologinForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: dologin.url(options),
            method: 'post',
        })
    
    dologin.form = dologinForm
/**
* @see \App\Http\Controllers\Admin\AuthController::logout
 * @see app/Http/Controllers/Admin/AuthController.php:39
 * @route '/admin/logout'
 */
export const logout = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: logout.url(options),
    method: 'get',
})

logout.definition = {
    methods: ["get","head"],
    url: '/admin/logout',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AuthController::logout
 * @see app/Http/Controllers/Admin/AuthController.php:39
 * @route '/admin/logout'
 */
logout.url = (options?: RouteQueryOptions) => {
    return logout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AuthController::logout
 * @see app/Http/Controllers/Admin/AuthController.php:39
 * @route '/admin/logout'
 */
logout.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: logout.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\AuthController::logout
 * @see app/Http/Controllers/Admin/AuthController.php:39
 * @route '/admin/logout'
 */
logout.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: logout.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\AuthController::logout
 * @see app/Http/Controllers/Admin/AuthController.php:39
 * @route '/admin/logout'
 */
    const logoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: logout.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\AuthController::logout
 * @see app/Http/Controllers/Admin/AuthController.php:39
 * @route '/admin/logout'
 */
        logoutForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: logout.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\AuthController::logout
 * @see app/Http/Controllers/Admin/AuthController.php:39
 * @route '/admin/logout'
 */
        logoutForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: logout.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    logout.form = logoutForm
const AuthController = { login, dologin, logout }

export default AuthController