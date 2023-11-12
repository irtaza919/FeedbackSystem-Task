<?php

        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;
        use App\Models\ComponentPermissions;
        use App\Models\Users;
        
        class Roles extends Model
        {
            use HasFactory;
        
                        public function component_permissions(){
                        return $this->hasMany(ComponentPermissions::class, "role_id","id");   
                        }
                        public function users(){
                        return $this->hasMany(Users::class, "role_id","id");   
                        }
                        
        }
        