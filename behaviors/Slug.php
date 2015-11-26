<?php

    namespace app\behaviors;

    use yii;
    use yii\base\Behavior;
    use yii\db\ActiveRecord;
    use yii\helpers\Inflector;
    use dosamigos\transliterator\TransliteratorHelper;

    class Slug extends Behavior
    {
        public $in_attribute = 'name';
        public $out_attribute = 'slug';
        public $translit = true;

        public function events()
        {
            return [
                ActiveRecord::EVENT_BEFORE_VALIDATE => 'getSlug'
            ];
        }

        /**
         * Делаем проверку пуст ли slug при сохранении и, если пуст, то генерируем его из name (заголовок записи).
         * Если же не пуст, то обрабатываем поступивший slug.
         *
         *@param $event
         */
        public function getSlug($event)
        {
            $attr = empty( $this->owner->{$this->out_attribute}) ?
                $this->in_attribute : $this->out_attribute;

            $this->owner->{$this->out_attribute} = $this->generateSlug( $this->owner->{$attr} );
        }

        /**
         * В первой строке метода мы функцией slugify убираем ненужные символы и переводим в транслит, если нужно
         *
         * @param $slug
         * @return string
         */
        private function generateSlug( $slug )
        {
            $slug = $this->slugify( $slug );
            if ( $this->checkUniqueSlug( $slug ) ) {
                return $slug;
            } else {
                for ( $suffix = 2; !$this->checkUniqueSlug( $new_slug = $slug . '-' . $suffix ); $suffix++ ) {}
                return $new_slug;
            }
        }

        /**
         * Транслитерируем, очищаем от неалфавитных символов, пробелы заменяем на черточку "-".
         *
         * @param $slug
         *
         * @return string
         */
        private function slugify( $slug )
        {
            if ( $this->translit ) {
                return Inflector::slug( TransliteratorHelper::process( $slug ), '-', true );
            } else {
                return $this->slug( $slug, '-', true );
            }
        }

        /**
         * Метод slug (урезанная версия yii\helpers\Inflector::slug без транлитерации):
         * @param $string
         * @param string $replacement
         * @param bool $lowercase
         *
         * @return string
         */
        private function slug( $string, $replacement = '-', $lowercase = true )
        {
            $string = preg_replace( '/[^\p{L}\p{Nd}]+/u', $replacement, $string );
            $string = trim( $string, $replacement );
            return $lowercase ? strtolower( $string ) : $string;
        }

        /**
         * проверяем slug на уникальность в базе
         * @param $slug
         *
         * @return bool
         */
        private function checkUniqueSlug( $slug )
        {
            $pk = $this->owner->primaryKey();
            $pk = $pk[0];

            $condition = $this->out_attribute . ' = :out_attribute';
            $params = [ ':out_attribute' => $slug ];
            if ( !$this->owner->isNewRecord ) {
                $condition .= ' and ' . $pk . ' != :pk';
                $params[':pk'] = $this->owner->{$pk};
            }

            return !$this->owner->find()
                ->where( $condition, $params )
                ->one();
        }



    }