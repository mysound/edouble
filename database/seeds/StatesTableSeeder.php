<?php

use App\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->truncate();
        
        State::create(['country_id' => '1', 'name' => 'Alaska', 'code' => 'AK']);
        State::create(['country_id' => '1', 'name' => 'Alabama', 'code' => 'AL']);
        State::create(['country_id' => '1', 'name' => 'Arizona', 'code' => 'AZ']);
        State::create(['country_id' => '1', 'name' => 'Arkansas', 'code' => 'AR']);
        State::create(['country_id' => '1', 'name' => 'California', 'code' => 'CA']);
        State::create(['country_id' => '1', 'name' => 'Colorado', 'code' => 'CO']);
        State::create(['country_id' => '1', 'name' => 'Connecticut', 'code' => 'CT']);
        State::create(['country_id' => '1', 'name' => 'Delaware', 'code' => 'DE']);
        State::create(['country_id' => '1', 'name' => 'District of Columbia', 'code' => 'DC']);
        State::create(['country_id' => '1', 'name' => 'Florida', 'code' => 'FL']);
        State::create(['country_id' => '1', 'name' => 'Georgia', 'code' => 'GA']);
        State::create(['country_id' => '1', 'name' => 'Hawaii', 'code' => 'HI']);
        State::create(['country_id' => '1', 'name' => 'Idaho', 'code' => 'ID']);
        State::create(['country_id' => '1', 'name' => 'Illinois', 'code' => 'IL']);
        State::create(['country_id' => '1', 'name' => 'Indiana', 'code' => 'IN']);
        State::create(['country_id' => '1', 'name' => 'Iowa', 'code' => 'IA']);
        State::create(['country_id' => '1', 'name' => 'Kansas', 'code' => 'KS']);
        State::create(['country_id' => '1', 'name' => 'Kentucky', 'code' => 'KY']);
        State::create(['country_id' => '1', 'name' => 'Louisiana', 'code' => 'LA']);
        State::create(['country_id' => '1', 'name' => 'Maine', 'code' => 'ME']);
        State::create(['country_id' => '1', 'name' => 'Maryland', 'code' => 'MD']);
        State::create(['country_id' => '1', 'name' => 'Massachusetts', 'code' => 'MA']);
        State::create(['country_id' => '1', 'name' => 'Michigan', 'code' => 'MI']);
        State::create(['country_id' => '1', 'name' => 'Minnesota', 'code' => 'MN']);
        State::create(['country_id' => '1', 'name' => 'Mississippi', 'code' => 'MS']);
        State::create(['country_id' => '1', 'name' => 'Missouri', 'code' => 'MO']);
        State::create(['country_id' => '1', 'name' => 'Montana', 'code' => 'MT']);
        State::create(['country_id' => '1', 'name' => 'Nebraska', 'code' => 'NE']);
        State::create(['country_id' => '1', 'name' => 'Nevada', 'code' => 'NV']);
        State::create(['country_id' => '1', 'name' => 'New Hampshire', 'code' => 'NH']);
        State::create(['country_id' => '1', 'name' => 'New Jersey', 'code' => 'NJ']);
        State::create(['country_id' => '1', 'name' => 'New Mexico', 'code' => 'NM']);
        State::create(['country_id' => '1', 'name' => 'New York', 'code' => 'NY']);
        State::create(['country_id' => '1', 'name' => 'North Carolina', 'code' => 'NC']);
        State::create(['country_id' => '1', 'name' => 'North Dakota', 'code' => 'ND']);
        State::create(['country_id' => '1', 'name' => 'Ohio', 'code' => 'OH']);
        State::create(['country_id' => '1', 'name' => 'Oklahoma', 'code' => 'OK']);
        State::create(['country_id' => '1', 'name' => 'Oregon', 'code' => 'OR']);
        State::create(['country_id' => '1', 'name' => 'Pennsylvania', 'code' => 'PA']);
        State::create(['country_id' => '1', 'name' => 'Rhode Island', 'code' => 'RI']);
        State::create(['country_id' => '1', 'name' => 'South Carolina', 'code' => 'SC']);
        State::create(['country_id' => '1', 'name' => 'South Dakota', 'code' => 'SD']);
        State::create(['country_id' => '1', 'name' => 'Tennessee', 'code' => 'TN']);
        State::create(['country_id' => '1', 'name' => 'Texas', 'code' => 'TX']);
        State::create(['country_id' => '1', 'name' => 'Utah', 'code' => 'UT']);
        State::create(['country_id' => '1', 'name' => 'Vermont', 'code' => 'VT']);
        State::create(['country_id' => '1', 'name' => 'Virginia', 'code' => 'VA']);
        State::create(['country_id' => '1', 'name' => 'Washington', 'code' => 'WA']);
        State::create(['country_id' => '1', 'name' => 'West Virginia', 'code' => 'WV']);
        State::create(['country_id' => '1', 'name' => 'Wisconsin', 'code' => 'WI']);
        State::create(['country_id' => '1', 'name' => 'Wyoming', 'code' => 'WY']);
    }
}
