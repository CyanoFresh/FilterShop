<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_parameter`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `parameter`
 */
class m161225_175313_create_junction_table_for_product_and_parameter_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_parameter', [
            'product_id' => $this->integer(),
            'parameter_id' => $this->integer(),
            'value' => $this->text(),
            'PRIMARY KEY(product_id, parameter_id)',
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_parameter-product_id',
            'product_parameter',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_parameter-product_id',
            'product_parameter',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `parameter_id`
        $this->createIndex(
            'idx-product_parameter-parameter_id',
            'product_parameter',
            'parameter_id'
        );

        // add foreign key for table `parameter`
        $this->addForeignKey(
            'fk-product_parameter-parameter_id',
            'product_parameter',
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
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-product_parameter-product_id',
            'product_parameter'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_parameter-product_id',
            'product_parameter'
        );

        // drops foreign key for table `parameter`
        $this->dropForeignKey(
            'fk-product_parameter-parameter_id',
            'product_parameter'
        );

        // drops index for column `parameter_id`
        $this->dropIndex(
            'idx-product_parameter-parameter_id',
            'product_parameter'
        );

        $this->dropTable('product_parameter');
    }
}
