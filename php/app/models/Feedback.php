<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Feedback.
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $feedback
 **/
class Feedback extends Model
{
    protected $table = 'feedback';
    public $timestamps = false;
    public function save(array $options = []): bool
    {
        return $this->validate() && parent::save($options);
    }
    public function validate(): bool
    {
        return str_contains($this->email, "@");
    }
}
