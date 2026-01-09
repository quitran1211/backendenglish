import Api from './Api'
import Admin from './Admin'
const Controllers = {
    Api: Object.assign(Api, Api),
Admin: Object.assign(Admin, Admin),
}

export default Controllers