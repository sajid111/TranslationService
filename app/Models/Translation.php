<?php

    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Translation extends Model
    {
        use HasFactory;

        protected $fillable = ['key_name', 'language_id', 'content'];

        public function language()
        {
            return $this->belongsTo(Language::class);
        }

        public function tags()
        {
            return $this->belongsToMany(Tag::class, 'translation_tag');
        }
    }

?>
