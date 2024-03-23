<?php

namespace App\Observers;

use Modules\Customer\Models\Customer; 
use App\Models\Upcoming_schedule_list;

class FieldUpdateObserver
{
    public function updating(Customer $model)
    {
        if ($model->isDirty('tags')) {
            $specific_field = 1;
            $details = [
                'customer_id' => $model->specific_field,
                'schedule_id' => $model->specific_field,
                'upcoming_date' => $model->specific_field,
                'status' => $model->$specific_field,
                // Other details you want to store
            ];

            // Create a new entry in the other table
            Upcoming_schedule_list::create($details);
        }
    }
}
