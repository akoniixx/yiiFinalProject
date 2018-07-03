<?php

use yii\db\Migration;

/**
 * Handles the creation of table `locations`.
 */
class m180701_134017_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('locations', [
            'location_id' => $this->primaryKey(),
            'location_name' => $this->string()->notNull(),
            'location_geo' => $this->string(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('locations');
    }
}
/*
INSERT INTO locations(location_name,location_geo)VALUES('กรุงเทพมหานคร','b');
INSERT INTO locations(location_name,location_geo)VALUES('เชียงราย','n');
INSERT INTO locations(location_name,location_geo)VALUES('เชียงใหม่','n');
INSERT INTO locations(location_name,location_geo)VALUES('น่าน','n');
INSERT INTO locations(location_name,location_geo)VALUES('พะเยา','n');
INSERT INTO locations(location_name,location_geo)VALUES('แพร่','n');
INSERT INTO locations(location_name,location_geo)VALUES('แม่ฮ่องสอน','n');
INSERT INTO locations(location_name,location_geo)VALUES('ลำปาง','n');
INSERT INTO locations(location_name,location_geo)VALUES('ลำพูน','n');
INSERT INTO locations(location_name,location_geo)VALUES('อุตรดิตถ์','n');
INSERT INTO locations(location_name,location_geo)VALUES('กาฬสินธุ์','ne');
INSERT INTO locations(location_name,location_geo)VALUES('ขอนแก่น','ne');
INSERT INTO locations(location_name,location_geo)VALUES('ชัยภูมิ','ne');
INSERT INTO locations(location_name,location_geo)VALUES('นครพนม','ne');
INSERT INTO locations(location_name,location_geo)VALUES('นครราชสีมา','ne');
INSERT INTO locations(location_name,location_geo)VALUES('บึงกาฬ','ne');
INSERT INTO locations(location_name,location_geo)VALUES('บุรีรัมย์','ne');
INSERT INTO locations(location_name,location_geo)VALUES('มหาสารคาม','ne');
INSERT INTO locations(location_name,location_geo)VALUES('มุกดาหาร','ne');
INSERT INTO locations(location_name,location_geo)VALUES('ยโสธร','ne');
INSERT INTO locations(location_name,location_geo)VALUES('ร้อยเอ็ด','ne');
INSERT INTO locations(location_name,location_geo)VALUES('เลย','ne');
INSERT INTO locations(location_name,location_geo)VALUES('สกลนคร','ne');
INSERT INTO locations(location_name,location_geo)VALUES('สุรินทร์','ne');
INSERT INTO locations(location_name,location_geo)VALUES('ศรีสะเกษ','ne');
INSERT INTO locations(location_name,location_geo)VALUES('หนองคาย','ne');
INSERT INTO locations(location_name,location_geo)VALUES('หนองบัวลำภู','ne');
INSERT INTO locations(location_name,location_geo)VALUES('อุดรธานี','ne');
INSERT INTO locations(location_name,location_geo)VALUES('อุบลราชธานี','ne');
INSERT INTO locations(location_name,location_geo)VALUES('อำนาจเจริญ','ne');
INSERT INTO locations(location_name,location_geo)VALUES('กำแพงเพชร','c');
INSERT INTO locations(location_name,location_geo)VALUES('ชัยนาท','c');
INSERT INTO locations(location_name,location_geo)VALUES('นครนายก','c');
INSERT INTO locations(location_name,location_geo)VALUES('นครปฐม','c');
INSERT INTO locations(location_name,location_geo)VALUES('นครสวรรค์','c');
INSERT INTO locations(location_name,location_geo)VALUES('นนทบุรี','c');
INSERT INTO locations(location_name,location_geo)VALUES('ปทุมธานี','c');
INSERT INTO locations(location_name,location_geo)VALUES('พระนครศรีอยุธยา','c');
INSERT INTO locations(location_name,location_geo)VALUES('พิจิตร','c');
INSERT INTO locations(location_name,location_geo)VALUES('พิษณุโลก','c');
INSERT INTO locations(location_name,location_geo)VALUES('เพชรบูรณ์','c');
INSERT INTO locations(location_name,location_geo)VALUES('ลพบุรี','c');
INSERT INTO locations(location_name,location_geo)VALUES('สมุทรปราการ','c');
INSERT INTO locations(location_name,location_geo)VALUES('สมุทรสงคราม','c');
INSERT INTO locations(location_name,location_geo)VALUES('สมุทรสาคร','c');
INSERT INTO locations(location_name,location_geo)VALUES('สิงห์บุรี','c');
INSERT INTO locations(location_name,location_geo)VALUES('สุโขทัย','c');
INSERT INTO locations(location_name,location_geo)VALUES('สุพรรณบุรี','c');
INSERT INTO locations(location_name,location_geo)VALUES('สระบุรี','c');
INSERT INTO locations(location_name,location_geo)VALUES('อ่างทอง','c');
INSERT INTO locations(location_name,location_geo)VALUES('อุทัยธานี','c');
INSERT INTO locations(location_name,location_geo)VALUES('จันทบุรี','e');
INSERT INTO locations(location_name,location_geo)VALUES('ฉะเชิงเทรา','e');
INSERT INTO locations(location_name,location_geo)VALUES('ชลบุรี','e');
INSERT INTO locations(location_name,location_geo)VALUES('ตราด','e');
INSERT INTO locations(location_name,location_geo)VALUES('ปราจีนบุรี','e');
INSERT INTO locations(location_name,location_geo)VALUES('ระยอง','e');
INSERT INTO locations(location_name,location_geo)VALUES('สระแก้ว','e');
INSERT INTO locations(location_name,location_geo)VALUES('กาญจนบุรี','w');
INSERT INTO locations(location_name,location_geo)VALUES('ตาก','w');
INSERT INTO locations(location_name,location_geo)VALUES('ประจวบคีรีขันธ์','w');
INSERT INTO locations(location_name,location_geo)VALUES('เพชรบุรี','w');
INSERT INTO locations(location_name,location_geo)VALUES('ราชบุรี','w');
INSERT INTO locations(location_name,location_geo)VALUES('กระบี่','s');
INSERT INTO locations(location_name,location_geo)VALUES('ชุมพร','s');
INSERT INTO locations(location_name,location_geo)VALUES('ตรัง','s');
INSERT INTO locations(location_name,location_geo)VALUES('นครศรีธรรมราช','s');
INSERT INTO locations(location_name,location_geo)VALUES('นราธิวาส','s');
INSERT INTO locations(location_name,location_geo)VALUES('ปัตตานี','s');
INSERT INTO locations(location_name,location_geo)VALUES('พังงา','s');
INSERT INTO locations(location_name,location_geo)VALUES('พัทลุง','s');
INSERT INTO locations(location_name,location_geo)VALUES('ภูเก็ต','s');
INSERT INTO locations(location_name,location_geo)VALUES('ระนอง','s');
INSERT INTO locations(location_name,location_geo)VALUES('สตูล','s');
INSERT INTO locations(location_name,location_geo)VALUES('สงขลา','s');
INSERT INTO locations(location_name,location_geo)VALUES('สุราษฎร์ธานี','s');
INSERT INTO locations(location_name,location_geo)VALUES('ยะลา','s');
*/
