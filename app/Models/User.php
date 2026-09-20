<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
//    Это аннотация PHPDoc для трейта HasFactory.
//HasFactory — это Laravel-трейт, который предоставляет метод factory(), используемый в тестировании и сидерах для создания тестовых записей.
//Аннотация @use HasFactory<UserFactory> указывает тип параметра шаблона — UserFactory. Это означает, что при вызове User::factory() будет возвращён экземпляр UserFactory, который настроен под модель User с правильными fillable-атрибутами и fake-данными.
//Без этой аннотации IDE (например, PhpStorm) не смогла бы корректно определить тип, возвращаемый User::factory(), и не предлагала бы автодополнение методов из UserFactory.
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
//        Метод casts() определяет, в какие типы нужно преобразовывать атрибуты модели при чтении/записи из БД.
//    Здесь два преобразования:
//
//'email_verified_at' => 'datetime' — строка из БД (например, 2026-09-20 12:00:00) автоматически превращается в объект Carbon (наследник DateTime), чтобы можно было вызывать .format(), .diffForHumans() и т.д.
//    'password' => 'hashed' — самое важное. При сохранении модели Laravel автоматически хеширует значение атрибута password, если оно ещё не было захешировано. Это значит, что в коде можно писать $user->password = '12345'; $user->save(); и Laravel сам вызовет bcrypt() / argon2(). При чтении из БД значение остаётся как есть (хеш-строка).
//    Без 'password' => 'hashed' пришлось бы вручную хешировать пароль при каждом создании/обновлении пользователя.
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
//        означает: у одного пользователя может быть много заявок (applications).
//    Laravel автоматически подставит user_id из текущей записи User и найдёт все соответствующие Application. Это избавляет от необходимости писать ручные SQL-запросы
    }
}
