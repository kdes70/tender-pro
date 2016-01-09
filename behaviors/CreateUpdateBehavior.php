<?php
    namespace app\behaviors;
    use yii\base\Behavior;
    use yii\db\ActiveRecord;

    /**
     * Поведение для автоматического проставления даты создания и создавшего/изменившего пользователя
     * Поведение TimestampBehavior доступное из коробки, не использовалось умышленно,
     * т.к. там только даты выставляются, и все равно пришлось бы создавать поведение
     * для проставления пользователей и в коробочном поведении, при добавлении записи,
     * выставляется дата обновления, а нам нужно только при обновлении.
     * Class CreateUpdateBehavior
     * @package common\components\behaviors
     * @author Bondarenko Kirill <bondarenko.kirill@gmail.com>
     */
    class CreateUpdateBehavior extends Behavior
    {
        /**
         * @var string поле в модели для даты создания
         */
        public $createAtField = 'created_at';

        /**
         * @var string поле в модели для создавшего пользователя
         */
        public $createUserField = 'user_id';

        /**
         * @var string поле в модели для даты обновления
         */
        public $updateAtField = 'updated_at';

        /**
         * @var string поле в модели для изменившего пользователя
         */
        public $updateUserField = 'update_user_id';

        /**
         * Подписываемся на события
         * @return array
         */
        public function events()
        {
            return [
                ActiveRecord::EVENT_BEFORE_INSERT => 'setInsertDateAndUser',
                ActiveRecord::EVENT_BEFORE_UPDATE => 'setUpdateDateAndUser',
            ];
        }

        /**
         * Устанавливаем дату создания и создавшего пользователя
         * @param $event
         */
        public function setInsertDateAndUser($event)
        {
            // Проверяем, что бы это был не консольный вызов, что бы
            // не получить ошибку, при попытке получить залогиненого пользователя
            if (!\Yii::$app->request->isConsoleRequest) {
                $createAtField = $this->createAtField;
                $createUserField = $this->createUserField;
                // заполняем дату создания и создавшего пользователя
                $this->owner->$createAtField = date('Y-m-d H:i:s');
                $this->owner->$createUserField = \Yii::$app->user->identity->id;
            }
        }

        /**
         * Изменяем дату обновления и обновившего пользователя
         * @param $event
         */
        public function setUpdateDateAndUser($event)
        {
            // получаем измененные атрибуты
            $attributes = $this->owner->getDirtyAttributes();

            // Из-за <a href="http://mypc.su/avtomaticheskoye-preobrazovaniye-dat-v-yii2/" target="_blank">ModifyDateBehavior</a>, в измененные попадают поля timestamp и datetime
            // если ModifyDateBehavior не используется - эти unset можно убрать
            if (isset($attributes[$this->updateAtField])) {
                unset($attributes[$this->updateAtField]);
            }

            if (isset($attributes[$this->createAtField])) {
                unset($attributes[$this->createAtField]);
            }

            // Аналогично предыдущему методу, только меняем дату обновления и обновившего пользователя
            if (!\Yii::$app->request->isConsoleRequest && $attributes) {
                $updateAtField = $this->updateAtField;
                $updateUserField = $this->updateUserField;
                $this->owner->$updateAtField = date('Y-m-d H:i:s');
                $this->owner->$updateUserField = \Yii::$app->user->identity->id;
            }
        }
    }