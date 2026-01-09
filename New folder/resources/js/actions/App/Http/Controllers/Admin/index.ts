import DashboardController from './DashboardController'
import LessonsController from './LessonsController'
import VocabularyController from './VocabularyController'
import LevelsController from './LevelsController'
import QuizController from './QuizController'
import QuizQuestionController from './QuizQuestionController'
import UsersController from './UsersController'
import AuthController from './AuthController'
const Admin = {
    DashboardController: Object.assign(DashboardController, DashboardController),
LessonsController: Object.assign(LessonsController, LessonsController),
VocabularyController: Object.assign(VocabularyController, VocabularyController),
LevelsController: Object.assign(LevelsController, LevelsController),
QuizController: Object.assign(QuizController, QuizController),
QuizQuestionController: Object.assign(QuizQuestionController, QuizQuestionController),
UsersController: Object.assign(UsersController, UsersController),
AuthController: Object.assign(AuthController, AuthController),
}

export default Admin