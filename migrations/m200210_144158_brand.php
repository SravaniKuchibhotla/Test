<?php

use yii\db\Migration;

/**
 * Class m200210_144158_brand
 */
class m200210_144158_brand extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('brand',[
            'brand_id' => $this->primaryKey(),
            'logo' => $this->string(100),
            'name' => $this->string(100),
            'updated' =>$this->timestamp()
        ]);

        $this->createTable('product',[
            'product_id' => $this->primaryKey(),
            'mpn' => $this->string(100),
            'brand_id' => $this->integer(100),
            'name' => $this->string(100),
            'updated' =>$this->timestamp()
        ]);

        $this->addForeignKey('FK_product_brand','product','brand_id','brand', 'brand_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_product_brand', 'product');
        $this->dropTable('product');
        $this->dropTable('brand');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200210_144158_brand cannot be reverted.\n";

        return false;
    }
    */
}
