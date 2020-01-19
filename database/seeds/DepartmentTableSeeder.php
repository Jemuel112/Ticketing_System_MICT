<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Department::truncate();
        $items = [
            ['dept_name' => 'Admin',],
            ['dept_name' => 'Anatomy',],
            ['dept_name' => 'Accounting',],
            ['dept_name' => 'Anesthesia',],
            ['dept_name' => 'ACSU',],
            ['dept_name' => 'Admitting',],
            ['dept_name' => 'Audit',],
            ['dept_name' => 'Billing',],
            ['dept_name' => 'BGC',],
            ['dept_name' => 'Biochemistry',],
            ['dept_name' => 'CPS',],
            ['dept_name' => 'Cashier',],
            ['dept_name' => 'CCU',],
            ['dept_name' => 'CSR',],
            ['dept_name' => 'Chemo',],
            ['dept_name' => 'Credit & Collection',],
            ['dept_name' => 'CT-Scan',],
            ['dept_name' => 'DR',],
            ['dept_name' => 'Doctors Office',],
            ['dept_name' => 'Dietary-MCU',],
            ['dept_name' => 'Deans Office',],
            ['dept_name' => 'Engineering',],
            ['dept_name' => 'ER',],
            ['dept_name' => 'Endoscopy',],
            ['dept_name' => 'ENT',],
            ['dept_name' => 'EVP',],
            ['dept_name' => 'Ethics',],
            ['dept_name' => 'FCM',],
            ['dept_name' => 'Foundation',],
            ['dept_name' => 'GSD',],
            ['dept_name' => 'Histopath',],
            ['dept_name' => 'Housekeeping',],
            ['dept_name' => 'Heart Station',],
            ['dept_name' => 'Hemo Dialysis',],
            ['dept_name' => 'Hearing Center',],
            ['dept_name' => 'IHC',],
            ['dept_name' => 'ICU',],
            ['dept_name' => 'Industrial',],
            ['dept_name' => 'Clinical Laboratories',],
            ['dept_name' => 'Marketing',],
            ['dept_name' => 'Medical Records',],
            ['dept_name' => 'MICT',],
            ['dept_name' => 'Medical Library',],
            ['dept_name' => 'Medicine',],
            ['dept_name' => 'Micropara',],
            ['dept_name' => 'MDO',],
            ['dept_name' => 'MSS',],
            ['dept_name' => 'MICU - CD',],
            ['dept_name' => 'MICU-Pay',],
            ['dept_name' => 'Medical Ward',],
            ['dept_name' => 'NICU',],
            ['dept_name' => 'Neuro',],
            ['dept_name' => 'NSO',],
            ['dept_name' => 'OB-Ward',],
            ['dept_name' => 'OPD-O.R',],
            ['dept_name' => 'OPD-ENT',],
            ['dept_name' => 'OPD-Ophtha',],
            ['dept_name' => 'OPD',],
            ['dept_name' => 'OB',],
            ['dept_name' => 'Ophtha',],
            ['dept_name' => 'Operating Room',],
            ['dept_name' => 'Pay 2',],
            ['dept_name' => 'Pay 4',],
            ['dept_name' => 'Pay 5',],
            ['dept_name' => 'Pain Center',],
            ['dept_name' => 'Pathology PBL',],
            ['dept_name' => 'Property & Supply',],
            ['dept_name' => 'Pharmacy - MedExpress',],
            ['dept_name' => 'Pulmo',],
            ['dept_name' => 'Pedia',],
            ['dept_name' => 'Physiology',],
            ['dept_name' => 'PICU',],
            ['dept_name' => 'Pedia Ward',],
            ['dept_name' => 'PDMD',],
            ['dept_name' => 'PSD',],
            ['dept_name' => 'Purchasing',],
            ['dept_name' => 'QAU',],
            ['dept_name' => 'Physical Rehab.',],
            ['dept_name' => 'Registrar',],
            ['dept_name' => 'Radiology',],
            ['dept_name' => 'Research',],
            ['dept_name' => 'SICU',],
            ['dept_name' => 'Surgical Ward',],
            ['dept_name' => 'Ultrasound',],
            ['dept_name' => 'View Center',],
            ['dept_name' => 'X-Ray',],
            ['dept_name' => 'Pharmacy - MCU',],
            ['dept_name' => 'Outside Institution',],
            ['dept_name' => 'Dietary-KCI',],
            ['dept_name' => 'Surgery Department',],
            ['dept_name' => 'Blood Bank',],

        ];
        foreach ($items as $item) {
            \App\Department::create($item);
        }
    }
}
