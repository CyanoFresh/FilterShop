<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_parameter`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `parameter`
 */
class m161225_175514_create_junction_table_for_category_and_parameter_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_parameter', [
            'category_id' => $this->integer(),
            'parameter_id' => $this->integer(),
            'PRIMARY KEY(category_id, parameter_id)',
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_parameter-category_id',
            'category_parameter',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_parameter-category_id',
            'category_parameter',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `parameter_id`
        $this->createIndex(
            'idx-category_parameter-parameter_id',
            'category_parameter',
            'parameter_id'
        );

        // add foreign key for table `parameter`
        $this->addForeignKey(
            'fk-category_parameter-parameter_id',
            'category_parameter',
            'parameter_id',
            'parameter',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-category_parameter-category_id',
            'category_parameter'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-category_parameter-category_id',
            'category_parameter'
        );

        // drops foreign key for table `parameter`
        $this->dropForeignKey(
            'fk-category_parameter-parameter_id',
            'category_parameter'
        );

        // drops index for column `parameter_id`
        $this->dropIndex(
            'idx-category_parameter-parameter_id',
            'category_parameter'
        );

        $this->dropTable('category_parameter');
    }
}
