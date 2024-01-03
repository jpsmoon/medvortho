<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClaimBillReview;

class ClaimBillReviews extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $claim_bill_reviews = array(
            array('id' => '1','claim_admin_id' => '3','name' => 'name1','contact_no' => '12121211','fax_no' => '','email' => '','website' => '','address_line1' => 'address, dfd fds f','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 00:23:23','updated_at' => '2022-01-31 00:23:23','deleted_at' => NULL),
            array('id' => '2','claim_admin_id' => '3','name' => 'name 2','contact_no' => '','fax_no' => '','email' => '','website' => '','address_line1' => 'addres dfdjkkdf j. fdj tesjdsfjdsk fdk fddjk dkjf','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 00:23:23','updated_at' => '2022-01-31 00:23:23','deleted_at' => NULL),
            array('id' => '3','claim_admin_id' => '4','name' => 'Mitchell International','contact_no' => '(877) 401-1411','fax_no' => '','email' => '','website' => '','address_line1' => '','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 00:34:02','updated_at' => '2022-01-31 00:34:02','deleted_at' => NULL),
            array('id' => '4','claim_admin_id' => '4','name' => 'Mitchell International','contact_no' => '(877) 401-1411','fax_no' => '','email' => '','website' => '','address_line1' => '','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 00:39:22','updated_at' => '2022-01-31 00:39:22','deleted_at' => NULL),
            array('id' => '5','claim_admin_id' => '5','name' => 'Mitchell International','contact_no' => '','fax_no' => '','email' => '','website' => '','address_line1' => '','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 00:39:49','updated_at' => '2022-01-31 00:39:49','deleted_at' => NULL),
            array('id' => '6','claim_admin_id' => '6','name' => 'Medata Service Bureau (San Francisco, CA)','contact_no' => '(888) 495-8111','fax_no' => '1245153','email' => '','website' => 'https://assist.medata.com/servicedesk/customer/user/','address_line1' => 'PO Box 881716, San Francisco, CA 94188','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 17:09:55','updated_at' => '2022-02-01 18:33:17','deleted_at' => NULL),
            array('id' => '7','claim_admin_id' => '7','name' => 'Medata Service Bureau (San Francisco, CA)','contact_no' => '(888) 495-8949','fax_no' => '','email' => '','website' => 'https://assist.medata.com/servicedesk/customer/user/','address_line1' => 'PO Box 881716, San Francisco, CA 94188','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 17:18:24','updated_at' => '2022-01-31 17:18:24','deleted_at' => NULL),
            array('id' => '8','claim_admin_id' => '8','name' => 'name1','contact_no' => '','fax_no' => '','email' => '','website' => '','address_line1' => 'PO Box 881716, San Francisco, CA 94188','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 17:47:28','updated_at' => '2022-01-31 17:47:28','deleted_at' => NULL),
            array('id' => '9','claim_admin_id' => '9','name' => 'Medata Service Bureau (San Francisco, CA)','contact_no' => '(888) 495-8949','fax_no' => '','email' => '','website' => '','address_line1' => 'PO Box 881716, San Francisco, CA 94188','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-01-31 18:51:31','updated_at' => '2022-01-31 18:51:31','deleted_at' => NULL),
            array('id' => '10','claim_admin_id' => '6','name' => 'meta serices','contact_no' => '1515151515','fax_no' => '','email' => '','website' => '','address_line1' => 'test','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2022-02-01 18:33:17','updated_at' => '2022-02-01 18:33:17','deleted_at' => NULL),
            array('id' => '11','claim_admin_id' => '10','name' => 'aa','contact_no' => 'a','fax_no' => '111111','email' => 'ss@gmail.com','website' => 's','address_line1' => '222','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-04-15 20:53:10','updated_at' => '2023-04-15 20:53:10','deleted_at' => NULL),
            array('id' => '13','claim_admin_id' => '2','name' => 'nuqexi@mailinator.com','contact_no' => 'serunyly@mailinator.com','fax_no' => 'bymyruhago@mailinator.com','email' => 'bufomi@mailinator.com','website' => 'fuzul@mailinator.com','address_line1' => '84 White Milton Drive','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-09-14 14:38:03','updated_at' => '2023-09-14 14:38:03','deleted_at' => NULL),
            array('id' => '14','claim_admin_id' => '2','name' => 'xorero@mailinator.com','contact_no' => 'biqajudyv@mailinator.com','fax_no' => 'buzejap@mailinator.com','email' => 'kuwyxep@mailinator.com','website' => 'xanapyf@mailinator.com','address_line1' => '610 New Parkway','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-09-14 14:38:03','updated_at' => '2023-09-14 14:38:03','deleted_at' => NULL),
            array('id' => '17','claim_admin_id' => '45','name' => 'Mitchell International','contact_no' => '(888) 380-5616','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '14295 Midway Road Ste. 300, Addison, TX 75001','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-10-09 14:36:09','updated_at' => '2023-10-09 14:36:09','deleted_at' => NULL),
            array('id' => '18','claim_admin_id' => '47','name' => 'Mitchell International (Farmers Insurance)','contact_no' => '(877) 401-1411','fax_no' => 'Unavailable','email' => 'Unavailable','website' => 'https://www.farmers.com/','address_line1' => 'PO Box 108843, Oklahoma City, OK 73101','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-03 09:20:27','updated_at' => '2023-12-03 09:20:27','deleted_at' => NULL),
            array('id' => '19','claim_admin_id' => '48','name' => 'Gallagher Bassett Manage Care Services','contact_no' => '(800) 370-0594 x1,5','fax_no' => 'Not provided','email' => 'Unavailable','website' => 'https://www.gallagherbassett.com/','address_line1' => 'PO Box 2831, Clinton, IA 52733-2831','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-03 09:25:31','updated_at' => '2023-12-03 09:25:31','deleted_at' => NULL),
            array('id' => '21','claim_admin_id' => '51','name' => 'Careworks (formerly MCMC)','contact_no' => '(615) 399-8658','fax_no' => '(615) 399-8671','email' => 'billstatus@careworks.com','website' => '-','address_line1' => '405 Duke Dr. Ste. 270, Franklin, TN 37067','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-03 10:42:35','updated_at' => '2023-12-03 10:42:35','deleted_at' => NULL),
            array('id' => '22','claim_admin_id' => '52','name' => 'Aggressive Medical Cost Containment, Inc. (AMCC)','contact_no' => '(847) 441-8822','fax_no' => '(847) 441-6788','email' => '-','website' => '-','address_line1' => '540 Frontage Rd, Ste 3220, Northfield, IL 60093','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-03 10:44:07','updated_at' => '2023-12-03 10:44:07','deleted_at' => NULL),
            array('id' => '23','claim_admin_id' => '49','name' => 'Reny Company','contact_no' => '(972) 250-0189','fax_no' => '(800) 747-4267','email' => '-','website' => '-','address_line1' => '1820 Preston Park, Suite 1900, Plano, TX 75093','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-03 10:55:14','updated_at' => '2023-12-03 10:55:14','deleted_at' => NULL),
            array('id' => '24','claim_admin_id' => '56','name' => 'Careworks (formerly MCMC)','contact_no' => '(888) 350-1150','fax_no' => '(724) 745-6960','email' => '-','website' => '-','address_line1' => '333 Technology Drive, Suite 108, Canonsburg, PA 15317','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-03 11:00:06','updated_at' => '2023-12-03 11:00:06','deleted_at' => NULL),
            array('id' => '25','claim_admin_id' => '44','name' => 'CorVel Corporation MedCheck','contact_no' => '(559) 447-0100','fax_no' => '(559) 447-0197','email' => '-','website' => '-','address_line1' => '30 River Park Place West #280, Fresno, CA 93720','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 09:34:18','updated_at' => '2023-12-04 09:34:18','deleted_at' => NULL),
            array('id' => '26','claim_admin_id' => '44','name' => 'Definiti Healthcare Management','contact_no' => '(949) 716-1891 x5','fax_no' => '(949) 716-1897','email' => '-','website' => '-','address_line1' => '26445 Rancho Parkway South, Lake Forest, CA 92630','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 09:34:18','updated_at' => '2023-12-04 09:34:18','deleted_at' => NULL),
            array('id' => '27','claim_admin_id' => '44','name' => 'Allied Managed Care (AMC) California','contact_no' => '(916) 563-1911','fax_no' => '(916) 362-3043','email' => 'BRCS@alliedmanagedcare.com','website' => '-','address_line1' => 'P.O. Box 269120, Sacramento, CA 95826','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 09:34:18','updated_at' => '2023-12-04 09:34:18','deleted_at' => NULL),
            array('id' => '28','claim_admin_id' => '44','name' => 'Conduent (formerly StrataCare)','contact_no' => '(949) 743-1230','fax_no' => 'Not provided','email' => 'workcompcallcenter@conduent.com','website' => '-','address_line1' => 'PO Box 19600, Irvine, CA 92623-9600','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 09:34:18','updated_at' => '2023-12-04 09:34:18','deleted_at' => NULL),
            array('id' => '29','claim_admin_id' => '44','name' => 'Lien on Me','contact_no' => '(626) 921-1120 x1','fax_no' => '(626) 921-1132','email' => '-','website' => '-','address_line1' => 'Po Box 91630, Pasadena, CA 91109','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 09:34:18','updated_at' => '2023-12-04 09:34:18','deleted_at' => NULL),
            array('id' => '30','claim_admin_id' => '44','name' => 'Risico Total Managed Care','contact_no' => '(559) 256-3596','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => 'PO Box 9783, Fresno, CA 93794','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 09:34:18','updated_at' => '2023-12-04 09:34:18','deleted_at' => NULL),
            array('id' => '31','claim_admin_id' => '64','name' => 'MedReview','contact_no' => '(909) 978-1130','fax_no' => '(909) 860-3995','email' => '-','website' => '-','address_line1' => '1470 South Valley Vista Dr. #230, Diamond Bar, CA 91765','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 09:51:20','updated_at' => '2023-12-04 09:51:20','deleted_at' => NULL),
            array('id' => '32','claim_admin_id' => '65','name' => 'Mitchell International','contact_no' => '(800) 732-0153','fax_no' => '(858) 586-2446','email' => '-','website' => '-','address_line1' => 'PO Box 2915, Clinton, IA 52733','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:00:02','updated_at' => '2023-12-04 10:00:02','deleted_at' => NULL),
            array('id' => '33','claim_admin_id' => '66','name' => 'Rising Medical Solutions','contact_no' => '(866) 274-7464','fax_no' => '(866) 767-3290','email' => 'customercare@risingms.com','website' => '-','address_line1' => '700 W. Virginia St. Ste. 401, Milwaukee, WI 53204','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:02:03','updated_at' => '2023-12-04 10:02:03','deleted_at' => NULL),
            array('id' => '34','claim_admin_id' => '68','name' => 'AIG Claims, Inc.','contact_no' => '(877) 802-5246 x3,1','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '-','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:06:05','updated_at' => '2023-12-04 10:06:05','deleted_at' => NULL),
            array('id' => '35','claim_admin_id' => '70','name' => 'CorVel Enterprise Comp, Inc','contact_no' => '(800) 987-1007','fax_no' => '(866) 708-4358','email' => 'Orange_PR@corvel.com','website' => '-','address_line1' => 'P.O. Box 669, Chino, CA 91708','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:13:18','updated_at' => '2023-12-04 10:13:18','deleted_at' => NULL),
            array('id' => '36','claim_admin_id' => '72','name' => 'Coventry Workers Comp Services','contact_no' => '(800) 937-6824','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '3611 Queen Palm Drive, Suite 150, Tampa, FL 33619','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:18:18','updated_at' => '2023-12-04 10:18:18','deleted_at' => NULL),
            array('id' => '37','claim_admin_id' => '73','name' => 'Allied Claims Administration','contact_no' => '','fax_no' => '','email' => '','website' => '','address_line1' => '','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:24:27','updated_at' => '2023-12-04 10:24:27','deleted_at' => NULL),
            array('id' => '38','claim_admin_id' => '74','name' => 'Genex Services, Inc.','contact_no' => '(800) 822-6099 x1','fax_no' => 'Not provided','email' => 'genexpccnotifications@mitchell.com','website' => '-','address_line1' => 'The Metrotech Center, 123 Wyoming Avenue, Scranton, PA 18503','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:30:36','updated_at' => '2023-12-04 10:30:36','deleted_at' => NULL),
            array('id' => '41','claim_admin_id' => '75','name' => 'Marquee Managed Care Solutions','contact_no' => '(619) 881-5510 x2','fax_no' => '(619) 881-5511','email' => '-','website' => '-','address_line1' => 'PO Box 85251, San Diego, CA 92186','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:36:19','updated_at' => '2023-12-04 10:36:19','deleted_at' => NULL),
            array('id' => '42','claim_admin_id' => '75','name' => 'American Claims Management','contact_no' => '(619) 744-5083','fax_no' => '(619) 744-5030','email' => '-','website' => '-','address_line1' => 'P.O. Box 85251, San Diego, CA 92186','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:36:19','updated_at' => '2023-12-04 10:36:19','deleted_at' => NULL),
            array('id' => '43','claim_admin_id' => '75','name' => 'Intelligent Medical Solutions, Inc. (IMS)','contact_no' => '(949) 465-7080 x3','fax_no' => '(949) 465-7089','email' => '-','website' => '-','address_line1' => '1 Spectrum Pointe Drive, Suite 140, Lake Forest, CA 92630','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:36:19','updated_at' => '2023-12-04 10:36:19','deleted_at' => NULL),
            array('id' => '44','claim_admin_id' => '76','name' => 'Conduent (American Equity Underwriters)','contact_no' => '(844) 922-0358 x1','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '-','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:50:46','updated_at' => '2023-12-04 10:50:46','deleted_at' => NULL),
            array('id' => '45','claim_admin_id' => '77','name' => 'Careworks (formerly MCMC)','contact_no' => '(888) 350-1150','fax_no' => '','email' => '-','website' => '-','address_line1' => '','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 10:56:43','updated_at' => '2023-12-04 10:56:43','deleted_at' => NULL),
            array('id' => '46','claim_admin_id' => '79','name' => 'Combined Claims Services, Inc.','contact_no' => '(402) 827-3425','fax_no' => '(888) 805-5907','email' => '-','website' => '-','address_line1' => 'PO Box 3484, Omaha, NE 68103-0464','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 11:23:20','updated_at' => '2023-12-04 11:23:20','deleted_at' => NULL),
            array('id' => '47','claim_admin_id' => '80','name' => 'Genex','contact_no' => '(610) 964-5100','fax_no' => 'Not provided','email' => 'genexpccnotifications@mitchell.com','website' => '-','address_line1' => '440 E Swedesford Rd., Suite 300, Wayne, PA 19087','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 11:32:03','updated_at' => '2023-12-04 11:32:03','deleted_at' => NULL),
            array('id' => '48','claim_admin_id' => '83','name' => 'Medata Service Bureau','contact_no' => '(800) 854-7591 x1','fax_no' => '(714) 918-1325','email' => '-','website' => 'https://assist.medata.com/servicedesk/customer/user/login','address_line1' => 'PO Box 61656, Irvine, CA 92602','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 11:44:10','updated_at' => '2023-12-04 11:44:10','deleted_at' => NULL),
            array('id' => '49','claim_admin_id' => '87','name' => 'ACS-CompIQ','contact_no' => '(877) 384-1071','fax_no' => '(714) 285-5829','email' => 'Providerservices@acs-inc.com','website' => '-','address_line1' => '1851 East 1st Street, Ste. 200, Santa Ana, CA 92705','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-04 12:03:00','updated_at' => '2023-12-04 12:03:00','deleted_at' => NULL),
          //   array('id' => '50','claim_admin_id' => '92','name' => 'Careworks (formerly MCMC)','contact_no' => '(888) 350-1150','fax_no' => '(724) 745-6960','email' => '-','website' => '-','address_line1' => '333 Technology Drive, Suite 108, Canonsburg, PA 15317','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:24:44','updated_at' => '2023-12-07 06:24:44','deleted_at' => NULL),
          //   array('id' => '51','claim_admin_id' => '93','name' => 'Genex','contact_no' => '(800) 822-6099','fax_no' => 'Not provided','email' => 'genexpccnotifications@mitchell.com','website' => '-','address_line1' => '10 E.D. Preate Drive, Moosic, PA 19087','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:27:48','updated_at' => '2023-12-07 06:27:48','deleted_at' => NULL),
          //   array('id' => '52','claim_admin_id' => '93','name' => 'Western Integrated Care','contact_no' => '(800) 674-5590','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '-','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:27:48','updated_at' => '2023-12-07 06:27:48','deleted_at' => NULL),
          //   array('id' => '53','claim_admin_id' => '95','name' => 'Mitchell International','contact_no' => '(800) 732-0153','fax_no' => '(858) 586-2446','email' => '-','website' => '-','address_line1' => 'PO Box 2915, Clinton, IA 52733','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:32:08','updated_at' => '2023-12-07 06:32:08','deleted_at' => NULL),
          //   array('id' => '54','claim_admin_id' => '96','name' => 'Mitchell International','contact_no' => '(800) 732-0153','fax_no' => '(858) 586-2446','email' => '-','website' => '-','address_line1' => 'PO Box 2915, Clinton, IA 52733','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:33:17','updated_at' => '2023-12-07 06:33:17','deleted_at' => NULL),
          //   array('id' => '55','claim_admin_id' => '97','name' => 'Careworks (formerly MCMC)','contact_no' => '(888) 350-1150','fax_no' => '(724) 745-6960','email' => '-','website' => '-','address_line1' => '333 Technology Drive, Suite 108, Canonsburg, PA 15317','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:35:01','updated_at' => '2023-12-07 06:35:01','deleted_at' => NULL),
          //   array('id' => '56','claim_admin_id' => '98','name' => 'Mitchell International','contact_no' => '(800) 732-0153','fax_no' => '(858) 586-2446','email' => '-','website' => '-','address_line1' => 'PO Box 2915, Clinton, IA 52733','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:36:41','updated_at' => '2023-12-07 06:36:41','deleted_at' => NULL),
          //   array('id' => '57','claim_admin_id' => '99','name' => 'Berkley Medical Management Solutions','contact_no' => '(800) 942-0225','fax_no' => 'Not provided','email' => 'mbr@berkleymms.com','website' => '-','address_line1' => 'PO Box 49129, Greensboro, NC 27419','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:38:34','updated_at' => '2023-12-07 06:38:34','deleted_at' => NULL),
          //   array('id' => '58','claim_admin_id' => '100','name' => 'Careworks (formerly MCMC)','contact_no' => '(888) 350-1150','fax_no' => '(724) 745-6960','email' => '-','website' => '-','address_line1' => '333 Technology Drive, Suite 108, Canonsburg, PA 15317','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:40:34','updated_at' => '2023-12-07 06:40:34','deleted_at' => NULL),
          //   array('id' => '59','claim_admin_id' => '101','name' => 'Mitchell International','contact_no' => '(800) 732-0153','fax_no' => '(858) 586-2446','email' => '-','website' => '-','address_line1' => 'PO Box 2915, Clinton, IA 52733','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:43:46','updated_at' => '2023-12-07 06:43:46','deleted_at' => NULL),
          //   array('id' => '60','claim_admin_id' => '102','name' => 'Mitchell International','contact_no' => '(800) 732-0153','fax_no' => '(858) 586-2446','email' => '-','website' => '-','address_line1' => 'PO Box 2915, Clinton, IA 52733','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 06:49:20','updated_at' => '2023-12-07 06:49:20','deleted_at' => NULL),
          //   array('id' => '61','claim_admin_id' => '106','name' => 'CompIQ Corp','contact_no' => '(877) 384-1071','fax_no' => '(925) 609-5306','email' => 'Providerservices@acs-inc.com','website' => '-','address_line1' => 'PO Box 4010, Concord, CA 94524','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 12:18:08','updated_at' => '2023-12-07 12:18:08','deleted_at' => NULL),
          //   array('id' => '62','claim_admin_id' => '108','name' => 'Coventry Workers Comp Services','contact_no' => '(800) 937-6824','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '3611 Queen Palm Drive, Suite 150, Tampa, FL 33619','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 12:43:00','updated_at' => '2023-12-07 12:43:00','deleted_at' => NULL),
          //   array('id' => '63','claim_admin_id' => '108','name' => 'CorVel Corporation (Care IQ)','contact_no' => '(866) 866-1101','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '550 Congressional Blvd, Suite 300, Carmel, IN 46032','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 12:43:00','updated_at' => '2023-12-07 12:43:00','deleted_at' => NULL),
          //   array('id' => '64','claim_admin_id' => '108','name' => 'EK Health Services, Inc.','contact_no' => '(888) 507-0616','fax_no' => 'Not provided','email' => 'providerinquiry@EKHealth.com','website' => '-','address_line1' => '992 S. De Anza Blvd. Ste. 101, San Jose, CA 95129','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 12:43:00','updated_at' => '2023-12-07 12:43:00','deleted_at' => NULL),
          //   array('id' => '65','claim_admin_id' => '108','name' => 'Broadspire Bill Review','contact_no' => '(800) 800-7885','fax_no' => 'Not provided','email' => 'Provider24@choosebroadspire.com','website' => '-','address_line1' => 'PO Box 14645, Lexington, KY 40512','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 12:43:00','updated_at' => '2023-12-07 12:43:00','deleted_at' => NULL),
          //   array('id' => '66','claim_admin_id' => '109','name' => 'Comptech Medical Management','contact_no' => '(913) 341-7600','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '-','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 12:44:36','updated_at' => '2023-12-07 12:44:36','deleted_at' => NULL),
          //   array('id' => '67','claim_admin_id' => '111','name' => 'Genex','contact_no' => '(800) 822-6099','fax_no' => 'Not provided','email' => 'genexpccnotifications@mitchell.com','website' => '-','address_line1' => '10 E.D. Preate Drive, Moosic, PA 19087','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 12:51:10','updated_at' => '2023-12-07 12:51:10','deleted_at' => NULL),
          //   array('id' => '68','claim_admin_id' => '112','name' => 'Employer\'s Choice Network (ECN)','contact_no' => '(800) 978-3550','fax_no' => '(866) 366-7977','email' => '-','website' => '-','address_line1' => '708 East Blvd, Charlotte, NC 28203','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 12:54:09','updated_at' => '2023-12-07 12:54:09','deleted_at' => NULL),
          //   array('id' => '69','claim_admin_id' => '115','name' => 'Medata Service Bureau','contact_no' => '(800) 854-7591 x1','fax_no' => '(714) 918-1325','email' => '-','website' => 'https://assist.medata.com/servicedesk/customer/user/login','address_line1' => 'PO Box 61656, Irvine, CA 92602
          
          // Alternate Phone: (877) 479-3817','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 13:02:15','updated_at' => '2023-12-07 13:02:15','deleted_at' => NULL),
          //   array('id' => '82','claim_admin_id' => '116','name' => 'Definiti Healthcare Management','contact_no' => '(949) 716-1891 x5','fax_no' => '(949) 716-1897','email' => '-','website' => '-','address_line1' => '26445 Rancho Parkway South, Lake Forest, CA 92630','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 13:16:06','updated_at' => '2023-12-07 13:16:06','deleted_at' => NULL),
          //   array('id' => '83','claim_admin_id' => '116','name' => 'CareSolutions','contact_no' => '(833) 444-5112','fax_no' => 'Not provided','email' => 'WorkCompCallCenter@conduent.com','website' => '-','address_line1' => 'PO Box 19600, Irvine, CA 92623-9600','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 13:16:06','updated_at' => '2023-12-07 13:16:06','deleted_at' => NULL),
          //   array('id' => '84','claim_admin_id' => '116','name' => 'Medex Managed Care','contact_no' => '(949) 221-1700','fax_no' => 'Not provided','email' => 'billreview@medexhco.com','website' => '-','address_line1' => '2618 San Miguel Dr. #477, Newport Beach, CA 92660','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 13:16:06','updated_at' => '2023-12-07 13:16:06','deleted_at' => NULL),
          //   array('id' => '85','claim_admin_id' => '116','name' => 'Genex','contact_no' => '(800) 822-6099','fax_no' => 'Not provided','email' => 'genexpccnotifications@mitchell.com','website' => '-','address_line1' => '10 E.D. Preate Drive, Moosic, PA 19087','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 13:16:06','updated_at' => '2023-12-07 13:16:06','deleted_at' => NULL),
          //   array('id' => '86','claim_admin_id' => '116','name' => 'CorVel Corporation','contact_no' => '(800) 987-1007','fax_no' => 'Not provided','email' => '-','website' => '-','address_line1' => '1100 W Town and Country Rd, Orange, CA 92868','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 13:16:06','updated_at' => '2023-12-07 13:16:06','deleted_at' => NULL),
          //   array('id' => '87','claim_admin_id' => '116','name' => 'Optum (formerly Equian)','contact_no' => '(866) 271-6317','fax_no' => 'Not provided','email' => '-','website' => '-',
          //   'address_line1' => 'PO Box 240338, Montgomery, AL 36124-0338','address_line2' => NULL,'city_id' => NULL,'state_id' => NULL,
          //   'zipcode' => NULL,'is_active' => '1','created_at' => '2023-12-07 13:16:06','updated_at' => '2023-12-07 13:16:06','deleted_at' => NULL)
          );
           foreach ($claim_bill_reviews as $review) {
            ClaimBillReview::create(['claim_admin_id'=>$review['claim_admin_id'], 'name' =>$review['name'], 'fax_no' =>$review['fax_no'],'email'=>$review['email'],'website' =>$review['website'],'address_line1' =>$review['address_line1'],'address_line2' =>$review['address_line2'],'city_id' =>$review['city_id'],
            'state_id' =>$review['state_id'], 'zipcode' =>$review['zipcode'],'is_active' =>$review['is_active'],'created_at' =>$review['created_at'],'updated_at' =>$review['updated_at']]);
          }
    }
}
