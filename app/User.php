<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'kategori_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function satker(): HasOne
    {
        return $this->hasOne('App\Icpsatkerprov', 'id', 'satker_id');
    }

    public function masyarakat(): HasOne
    {
        return $this->hasOne('App\Masyarakat', 'id', 'masyarakat_id');
    }
    
    public function kategoris()
    {
        return $this->belongsTo('App\Kategori', 'kategori_id');
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}


class CustomResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(['balitbangjatim.repository@gmail.com' => 'SISFOLITBANG'])
            ->subject( 'Reset Password SISFOLITBANG' )
            ->greeting('Dengan Hormat, ')
            ->line('Sehubungan dengan permintaan <strong>Reset Password</strong> dari pengguna, pesan elektronik ini dikirim sebagai bagian dari prosedur.')
            ->line('Silakan tekan tombol berikut untuk melanjutkan.')
            ->action('Reset Password', url(config('app.url') . route('password.reset', $this->token, false)))
            ->line('Jika anda tidak merasa melakukan permintaan Reset Password, silakan abaikan pesan ini.')
            ->line('Terima kasih atas perhatian anda.')
            ->salutation('Badan Penelitian dan Pengembangan<br> Provinsi Jawa Timur');
    }
}

