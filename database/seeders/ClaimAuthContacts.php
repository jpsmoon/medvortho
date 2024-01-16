<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClaimAuthContact;

class ClaimAuthContacts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $claim_auth_contacts = array(
            array('id' => '1','claim_admin_id' => '6','rfa_contact_no' => '122521236224','rfa_fax_no' => '(415) 675-4230','is_active' => '1','created_at' => '2022-01-31 17:14:38','updated_at' => '2022-02-01 18:36:20','deleted_at' => NULL),
            array('id' => '2','claim_admin_id' => '6','rfa_contact_no' => '(800) 661-6029','rfa_fax_no' => '23232323','is_active' => '1','created_at' => '2022-01-31 17:14:38','updated_at' => '2022-02-01 18:36:21','deleted_at' => NULL),
            array('id' => '3','claim_admin_id' => '8','rfa_contact_no' => '122521236224','rfa_fax_no' => NULL,'is_active' => '1','created_at' => '2022-01-31 17:47:34','updated_at' => '2022-01-31 17:47:34','deleted_at' => NULL),
            array('id' => '4','claim_admin_id' => '9','rfa_contact_no' => '(800) 661-6029','rfa_fax_no' => '(800) 661-6029','is_active' => '1','created_at' => '2022-01-31 18:51:47','updated_at' => '2022-01-31 18:51:47','deleted_at' => NULL),
            array('id' => '5','claim_admin_id' => '6','rfa_contact_no' => '4545454554','rfa_fax_no' => '','is_active' => '1','created_at' => '2022-02-01 18:36:21','updated_at' => '2022-02-01 18:36:21','deleted_at' => NULL),
            array('id' => '6','claim_admin_id' => '10','rfa_contact_no' => '123','rfa_fax_no' => '2322','is_active' => '1','created_at' => '2023-04-15 20:53:21','updated_at' => '2023-04-15 20:53:21','deleted_at' => NULL),
            array('id' => '8','claim_admin_id' => '2','rfa_contact_no' => 'maloqerahe@mailinator.com','rfa_fax_no' => 'riqigyx@mailinator.com','is_active' => '1','created_at' => '2023-09-14 14:38:03','updated_at' => '2023-09-14 14:38:03','deleted_at' => NULL),
            array('id' => '9','claim_admin_id' => '2','rfa_contact_no' => 'cufonohu@mailinator.com','rfa_fax_no' => 'xehefazos@mailinator.com','is_active' => '1','created_at' => '2023-09-14 14:38:03','updated_at' => '2023-09-14 14:38:03','deleted_at' => NULL),
            array('id' => '12','claim_admin_id' => '45','rfa_contact_no' => '(888) 239-3909','rfa_fax_no' => '(216) 643-5500','is_active' => '1','created_at' => '2023-10-09 14:36:09','updated_at' => '2023-10-09 14:36:09','deleted_at' => NULL),
            array('id' => '13','claim_admin_id' => '47','rfa_contact_no' => '(866) 967-5256','rfa_fax_no' => '(866) 846-3114','is_active' => '1','created_at' => '2023-12-03 09:20:27','updated_at' => '2023-12-03 09:20:27','deleted_at' => NULL),
            array('id' => '15','claim_admin_id' => '49','rfa_contact_no' => '(800) 228-8602','rfa_fax_no' => '(800) 833-1851','is_active' => '1','created_at' => '2023-12-03 10:55:14','updated_at' => '2023-12-03 10:55:14','deleted_at' => NULL),
            array('id' => '16','claim_admin_id' => '44','rfa_contact_no' => '(800) 444-6157','rfa_fax_no' => '(916) 563-1919','is_active' => '1','created_at' => '2023-12-04 09:34:18','updated_at' => '2023-12-04 09:34:18','deleted_at' => NULL),
            array('id' => '17','claim_admin_id' => '64','rfa_contact_no' => '(909) 861-0816','rfa_fax_no' => '(909) 978-2970','is_active' => '1','created_at' => '2023-12-04 09:51:20','updated_at' => '2023-12-04 09:51:20','deleted_at' => NULL),
            array('id' => '18','claim_admin_id' => '65','rfa_contact_no' => '(916) 888-1700','rfa_fax_no' => '(888) 263-5001','is_active' => '1','created_at' => '2023-12-04 10:00:02','updated_at' => '2023-12-04 10:00:02','deleted_at' => NULL),
            array('id' => '19','claim_admin_id' => '67','rfa_contact_no' => '(559) 481-7100','rfa_fax_no' => '(559) 862-4997','is_active' => '1','created_at' => '2023-12-04 10:04:13','updated_at' => '2023-12-04 10:04:13','deleted_at' => NULL),
            array('id' => '20','claim_admin_id' => '68','rfa_contact_no' => '(877) 479-3829','rfa_fax_no' => '(866) 739-6983','is_active' => '1','created_at' => '2023-12-04 10:06:05','updated_at' => '2023-12-04 10:06:05','deleted_at' => NULL),
            array('id' => '21','claim_admin_id' => '70','rfa_contact_no' => '(415) 248-5030','rfa_fax_no' => '(415) 248-5035','is_active' => '1','created_at' => '2023-12-04 10:13:18','updated_at' => '2023-12-04 10:13:18','deleted_at' => NULL),
            array('id' => '22','claim_admin_id' => '75','rfa_contact_no' => '(866) 671-5042','rfa_fax_no' => '(619) 744-5030','is_active' => '1','created_at' => '2023-12-04 10:36:19','updated_at' => '2023-12-04 10:36:19','deleted_at' => NULL),
            array('id' => '23','claim_admin_id' => '76','rfa_contact_no' => '(504) 840-6500','rfa_fax_no' => '(504) 834-5041','is_active' => '1','created_at' => '2023-12-04 10:50:46','updated_at' => '2023-12-04 10:50:46','deleted_at' => NULL),
            array('id' => '24','claim_admin_id' => '77','rfa_contact_no' => '(800) 257-1900','rfa_fax_no' => '(248) 615-8602','is_active' => '1','created_at' => '2023-12-04 10:56:43','updated_at' => '2023-12-04 10:56:43','deleted_at' => NULL),
            array('id' => '25','claim_admin_id' => '79','rfa_contact_no' => '(800) 615-4320','rfa_fax_no' => '(866) 234-4416','is_active' => '1','created_at' => '2023-12-04 11:23:20','updated_at' => '2023-12-04 11:23:20','deleted_at' => NULL),
            array('id' => '26','claim_admin_id' => '80','rfa_contact_no' => '(800) 777-3602','rfa_fax_no' => '(210) 321-6526','is_active' => '1','created_at' => '2023-12-04 11:32:03','updated_at' => '2023-12-04 11:32:03','deleted_at' => NULL),
            array('id' => '27','claim_admin_id' => '83','rfa_contact_no' => '(704) 522-2000','rfa_fax_no' => '(704) 522-3300','is_active' => '1','created_at' => '2023-12-04 11:44:10','updated_at' => '2023-12-04 11:44:10','deleted_at' => NULL),
            array('id' => '28','claim_admin_id' => '87','rfa_contact_no' => '(877) 494-4300','rfa_fax_no' => '(888) 673-6364','is_active' => '1','created_at' => '2023-12-04 12:03:00','updated_at' => '2023-12-04 12:03:00','deleted_at' => NULL),
            // array('id' => '29','claim_admin_id' => '93','rfa_contact_no' => '(909) 843-9155','rfa_fax_no' => '(909) 843-9156','is_active' => '1','created_at' => '2023-12-07 06:27:48','updated_at' => '2023-12-07 06:27:48','deleted_at' => NULL),
            // array('id' => '30','claim_admin_id' => '98','rfa_contact_no' => '(703) 586-6300','rfa_fax_no' => '(858) 586-2444','is_active' => '1','created_at' => '2023-12-07 06:36:41','updated_at' => '2023-12-07 06:36:41','deleted_at' => NULL),
            // array('id' => '31','claim_admin_id' => '101','rfa_contact_no' => '(800) 259-2560','rfa_fax_no' => '(866) 360-1718','is_active' => '1','created_at' => '2023-12-07 06:43:46','updated_at' => '2023-12-07 06:43:46','deleted_at' => NULL),
            // array('id' => '32','claim_admin_id' => '102','rfa_contact_no' => '(888) 504-1863','rfa_fax_no' => '(570) 825-0611','is_active' => '1','created_at' => '2023-12-07 06:49:20','updated_at' => '2023-12-07 06:49:20','deleted_at' => NULL),
            // array('id' => '33','claim_admin_id' => '108','rfa_contact_no' => '(800) 800-7660','rfa_fax_no' => '(770) 777-6447','is_active' => '1','created_at' => '2023-12-07 12:43:00','updated_at' => '2023-12-07 12:43:00','deleted_at' => NULL),
            // array('id' => '34','claim_admin_id' => '109','rfa_contact_no' => '(800) 333-3735','rfa_fax_no' => '(800) 284-9579','is_active' => '1','created_at' => '2023-12-07 12:44:36','updated_at' => '2023-12-07 12:44:36','deleted_at' => NULL),
            // array('id' => '35','claim_admin_id' => '115','rfa_contact_no' => '(818) 844-4300','rfa_fax_no' => '(818) 291-1863','is_active' => '1','created_at' => '2023-12-07 13:02:15','updated_at' => '2023-12-07 13:02:15','deleted_at' => NULL)
          );
           foreach ($claim_auth_contacts as $contact) {
            ClaimAuthContact::create(['claim_admin_id' => $contact['claim_admin_id'], 'rfa_contact_no' => $contact['rfa_contact_no'],'rfa_fax_no' => $contact['rfa_fax_no'] ,'is_active' => $contact['is_active'],'created_at' => $contact['created_at'],'updated_at' => $contact['updated_at']]);
          }
    }
}
