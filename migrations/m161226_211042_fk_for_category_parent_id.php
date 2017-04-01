<?php

use yii\db\Migration;

class m161226_211042_fk_for_category_parent_id extends Migration
{
    public function safeUp()
    {
        $this->createIndex('idx-category-parent_id', 'category', 'parent_id');
        $this->addForeignKey('fk-category-parent_id', 'category', 'parent_id', 'category', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-category-parent_id', 'category');
        $this->dropIndex('idx-category-parent_id', 'category');
    }
}
