<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\InventoryInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventory_infos=[
            [
                'name' => 'Biogesic',
                'dosage' => '20',
                'quantity' => 480,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Decolgen',
                'dosage' => '12',
                'quantity' => 780,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Tuseran',
                'dosage' => '10',
                'quantity' => 500,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Isodril',
                'dosage' => '15',
                'quantity' => 610,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Neobloc',
                'dosage' => '50',
                'quantity' => 120,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Sinutab',
                'dosage' => '15',
                'quantity' => 623,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Serc',
                'dosage' => '16',
                'quantity' => 200,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Bioflu',
                'dosage' => '20',
                'quantity' => 320,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Feldene Flash',
                'dosage' => '8',
                'quantity' => 223,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Neozep',
                'dosage' => '22',
                'quantity' => 330,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Calcibloc',
                'dosage' => '10',
                'quantity' => 120,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Mefenamic Acid',
                'dosage' => '12',
                'quantity' => 500,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Dizitab',
                'dosage' => '25',
                'quantity' => 250,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Kremil S',
                'dosage' => '25',
                'quantity' => 251,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Omeprazole',
                'dosage' => '13',
                'quantity' => 133,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Sinupret',
                'dosage' => '12',
                'quantity' => 150,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Catapress',
                'dosage' => '.75',
                'quantity' => 80,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Catopril',
                'dosage' => '25',
                'quantity' => 30,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Ambroxol',
                'dosage' => '30',
                'quantity' => 303,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Telfast',
                'dosage' => '18',
                'quantity' => 184,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Alerta',
                'dosage' => '12',
                'quantity' => 220,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Alnix',
                'dosage' => '3',
                'quantity' => 38,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Cetirizine',
                'dosage' => '13',
                'quantity' => 121,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Buscopan',
                'dosage' => '9',
                'quantity' => 75,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Buscopan Venus',
                'dosage' => '12',
                'quantity' => 33,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Sambong',
                'dosage' => '20',
                'quantity' => 44,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Benadryl',
                'dosage' => '10',
                'quantity' => 88,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Alaxan FR',
                'dosage' => '25',
                'quantity' => 81,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Symdex D',
                'dosage' => '5',
                'quantity' => 50,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Loperamide',
                'dosage' => '13',
                'quantity' => 410,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Plasil',
                'dosage' => '10',
                'quantity' => 42,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Midol',
                'dosage' => '10',
                'quantity' => 79,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Advil',
                'dosage' => '14',
                'quantity' => 210,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Carbocisteine',
                'dosage' => '16',
                'quantity' => 22,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Ascof',
                'dosage' => '10',
                'quantity' => 300,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Salbutamol',
                'dosage' => '12',
                'quantity' => 12,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Ventolin Nebule',
                'dosage' => '25',
                'quantity' => 33,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Dequadine',
                'dosage' => '11',
                'quantity' => 60,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Sinecod',
                'dosage' => '14',
                'quantity' => 40,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Hydrite',
                'dosage' => '30',
                'quantity' => 66,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Band-Aid Visine',
                'dosage' => '0',
                'quantity' => 57,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Antigen Test Kit',
                'dosage' => '0',
                'quantity' => 123,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Salonpas',
                'dosage' => '0',
                'quantity' => 72,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Omega Pain Killer',
                'dosage' => '20',
                'quantity' => 34,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Bactidol',
                'dosage' => '120',
                'quantity' => 12,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Betadine',
                'dosage' => '100',
                'quantity' => 18,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Dequadin',
                'dosage' => '100',
                'quantity' => 8,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Cotton',
                'dosage' => '0',
                'quantity' => 20,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Cotton Buds',
                'dosage' => '0',
                'quantity' => 42,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Transpore',
                'dosage' => '0',
                'quantity' => 20,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Mediplast',
                'dosage' => '0',
                'quantity' => 60,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Sure-Guard',
                'dosage' => '0',
                'quantity' => 41,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Bactifree',
                'dosage' => '5000',
                'quantity' => 5,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Cutasept',
                'dosage' => '250',
                'quantity' => 21,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Lancets',
                'dosage' => '0',
                'quantity' => 150,
                'type' => 'Equipment',
            ],
            [
                'name' => 'Agua Oxigenada',
                'dosage' => '120',
                'quantity' => 6,
                'type' => 'Medicine',
            ],
            [
                'name' => 'Alcohol',
                'dosage' => '120',
                'quantity' => 3,
                'type' => 'Medicine',
            ],
        ];
        foreach ($inventory_infos as $key => $inventory_infos) {
            $inventory = Inventory::create();
            InventoryInfo::create([
                'inventory_id' => $inventory->id,
                'name' => $inventory_infos['name'],
                'dosage'=> $inventory_infos['dosage'],
                'quantity'=> $inventory_infos['quantity'],
                'type'=> $inventory_infos['type'],
            ]);
        }
    }
}
