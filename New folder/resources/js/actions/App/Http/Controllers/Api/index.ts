import UserController from './UserController'
import DictionaryController from './DictionaryController'
import LevelController from './LevelController'
import LessonController from './LessonController'
import VocabularyController from './VocabularyController'
import QuizController from './QuizController'
import QuizQuestionController from './QuizQuestionController'
import UserLessonProgressController from './UserLessonProgressController'
import QuizResultController from './QuizResultController'
const Api = {
    UserController: Object.assign(UserController, UserController),
DictionaryController: Object.assign(DictionaryController, DictionaryController),
LevelController: Object.assign(LevelController, LevelController),
LessonController: Object.assign(LessonController, LessonController),
VocabularyController: Object.assign(VocabularyController, VocabularyController),
QuizController: Object.assign(QuizController, QuizController),
QuizQuestionController: Object.assign(QuizQuestionController, QuizQuestionController),
UserLessonProgressController: Object.assign(UserLessonProgressController, UserLessonProgressController),
QuizResultController: Object.assign(QuizResultController, QuizResultController),
}

export default Api