<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            [
                'title' => 'Militantum',
                'artist' => 'Тёмный принц',
                'label' => 'Студийный альбом',
                'full_description' => 'Дебютный студийный альбом «Militantum» вышел летом 2026 года. В него вошли 3 трека, записанные в жанре альтернативного рэпа.',
                'release_date' => '2026-06-01',
                'cover_image' => 'https://storage.yandexcloud.net/static-production/rztbackend/releases/86713/f6c7cda6-cfa5-414e-99dc-e5f5168d7db5.jpg',
                'tracks' => "Вступление — 2:15\nMilitantum — 3:42\nНочь — 2:58",
            ],
            [
                'title' => 'Красивое зло',
                'artist' => 'Villian',
                'label' => 'Студийный альбом',
                'full_description' => 'Альбом «Красивое зло» — вторая студийная работа исполнителя Villian. Мрачная атмосфера и тяжёлые биты.',
                'release_date' => '2026-05-15',
                'cover_image' => 'https://t2.genius.com/unsafe/300x300/https%3A%2F%2Fimages.genius.com%2F7098c60877db6e98149fff7af8a7b47e.1000x1000x1.png',
                'tracks' => "Интро — 1:50\nКрасивое зло — 3:10\nТишина — 2:45",
            ],
            [
                'title' => 'Орео',
                'artist' => 'Mayot',
                'label' => 'Студийный альбом',
                'full_description' => '«Орео» — летний альбом Mayot. Лёгкое звучание и танцевальные ритмы.',
                'release_date' => '2026-07-01',
                'cover_image' => 'https://t2.genius.com/unsafe/300x300/https%3A%2F%2Fimages.genius.com%2F72bd91e8fd41e6783bb49900117a66dd.1000x1000x1.png',
                'tracks' => "Орео — 2:30\nЛето — 3:05\nДом — 2:22",
            ],
            [
                'title' => 'Врубай на полную!',
                'artist' => 'Руки Вверх!',
                'label' => 'Студийный альбом',
                'full_description' => 'Новый альбом легендарной группы «Руки Вверх!». Знакомые мотивы и новая энергия.',
                'release_date' => '2026-06-20',
                'cover_image' => 'https://cdn1.intermedia.ru/img/news_x400/405480.jpg?t=1784841056',
                'tracks' => "Врубай — 3:20\nТанцуй — 2:55\nНочь — 3:40",
            ],
            [
                'title' => 'Shh!',
                'artist' => 'Kai angel',
                'label' => 'Сольный альбом',
                'full_description' => 'Сольный проект Kai angel «Shh!». Короткие, но очень плотные треки.',
                'release_date' => '2026-08-01',
                'cover_image' => 'https://avatars.yandex.net/get-music-content/20837190/b6f3028a.a.43917005-1/m1000x1000',
                'tracks' => "Shh! — 1:00\nchateau — 1:56\nGladiator — 1:43",
            ],
        ];

        foreach ($albums as $album) {
            Album::create($album);
        }
    }
}