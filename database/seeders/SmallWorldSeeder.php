<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SmallWorldSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = Carbon::now();

            $editions = [
                'Small World (base)',
                'Small World: Cursed!',
                'Small World: Grand Dames',
                'Small World: Royal Bonus',
                'Small World: Be Not Afraid!',
                'Small World: A Spider\'s Web',
                'Small World: Sky Islands',
                'Small World: Underground',
            ];

            foreach ($editions as $name) {
                DB::table('smallworld.editions')->updateOrInsert(
                    ['name' => $name],
                    ['updated_at' => $now, 'created_at' => $now]
                );
            }

            $editionIds = DB::table('smallworld.editions')->pluck('id', 'name');

            DB::statement('DELETE FROM smallworld.races');
            DB::statement('DELETE FROM smallworld.abilities');

            $races = [
                // Base
                ['Амазонки', 6, 'Во время завоеваний получают 4 временных жетона.', 'Small World (base)'],
                ['Гномы', 3, 'Монеты за шахты.', 'Small World (base)'],
                ['Эльфы', 6, 'Потери возвращаются в руку.', 'Small World (base)'],
                ['Упыри', 5, 'В упадке продолжают захватывать.', 'Small World (base)'],
                ['Великаны', 6, 'Со скал атакуют на 1 дешевле.', 'Small World (base)'],
                ['Полурослики', 6, 'Два логова, неуязвимые регионы.', 'Small World (base)'],
                ['Люди', 5, 'Монеты за поля.', 'Small World (base)'],
                ['Орки', 5, 'Монеты за захват занятых регионов.', 'Small World (base)'],
                ['Крысолюды', 8, 'Много жетонов, без бонусов.', 'Small World (base)'],
                ['Скелеты', 6, 'Получают жетоны за захваты.', 'Small World (base)'],
                ['Колдуны', 5, 'Превращают одиночные жетоны.', 'Small World (base)'],
                ['Тритоны', 6, 'У воды атакуют на 1 дешевле.', 'Small World (base)'],
                ['Тролли', 5, 'Логова +1 к защите.', 'Small World (base)'],
                ['Волшебники', 5, 'Монеты за магические символы.', 'Small World (base)'],

                // Cursed!
                ['Гоблины', 6, 'Дешевле берут регионы с упадшими.', 'Small World: Cursed!'],
                ['Кобольды', 11, 'Нельзя оставлять одиночные жетоны.', 'Small World: Cursed!'],

                // Grand Dames
                ['Цыгане', 6, 'Переезд даёт монеты.', 'Small World: Grand Dames'],
                ['Жрицы', 4, 'Храм прячет жетоны при упадке.', 'Small World: Grand Dames'],
                ['Белые Дамы', 2, 'Неуязвимы, но мало жетонов.', 'Small World: Grand Dames'],

                // Royal Bonus
                ['Фавны', 5, 'Бонус за сопредельные захваты.', 'Small World: Royal Bonus'],
                ['Игорьцы', 4, 'Забирают жетоны побеждённых.', 'Small World: Royal Bonus'],
                ['Кустолюды', 6, 'Бонус за леса при упадке.', 'Small World: Royal Bonus'],

                // Be Not Afraid!
                ['Варвары', 9, 'Не перегруппировываются.', 'Small World: Be Not Afraid!'],
                ['Гомункулы', 5, 'Чем дольше не берут — тем больше.', 'Small World: Be Not Afraid!'],
                ['Лепреконы', 6, 'Кладут горшочки с золотом.', 'Small World: Be Not Afraid!'],
                ['Пикси', 11, 'В регионах остаётся по одному.', 'Small World: Be Not Afraid!'],
                ['Пигмеи', 6, 'Возвращаются из запаса при потере.', 'Small World: Be Not Afraid!'],

                // A Spider's Web
                ['Ледяные Ведьмы', 5, 'Замораживают соседей.', 'Small World: A Spider\'s Web'],
                ['Скагги', 6, 'Бонус за рассредоточение.', 'Small World: A Spider\'s Web'],
                ['Пращники', 5, 'Дальние захваты.', 'Small World: A Spider\'s Web'],

                // Sky Islands
                ['Драконы', 6, 'Временно превращают жетоны в драконов.', 'Small World: Sky Islands'],
                ['Эскарго', 12, 'Медленные, но многочисленные.', 'Small World: Sky Islands'],
                ['Ханы', 5, 'Набеги по степям.', 'Small World: Sky Islands'],
                ['Пугала', 12, 'Иммунные пустышки-охранники.', 'Small World: Sky Islands'],
                ['Падальщики', 6, 'Монеты за опустошённые регионы.', 'Small World: Sky Islands'],
                ['Грозовые Великаны', 6, 'Молнии для штурма.', 'Small World: Sky Islands'],
                ['Вендиго', 6, 'Замораживают регионы.', 'Small World: Sky Islands'],

                // Underground (все с числами с баннеров)
                ['Культисты', 5, 'Древний делает соседние регионы дешевле.', 'Small World: Underground'],
                ['Дроу', 6, 'Монеты за изолированные регионы.', 'Small World: Underground'],
                ['Пламя', 4, 'Вулкан делает соседние регионы пустыми для атаки.', 'Small World: Underground'],
                ['Гномы Подземья', 7, 'Неуязвимы для эффектов соперников на их ход.', 'Small World: Underground'],
                ['Железные Гномы', 7, 'Куют серебряные молоты для атаки.', 'Small World: Underground'],
                ['Грязевики', 7, 'Получают жетоны из грязевых луж.', 'Small World: Underground'],
                ['Мумии', 10, 'Все завоевания дороже на 1.', 'Small World: Underground'],
                ['Огры', 5, 'Захватывают на 1 дешевле.', 'Small World: Underground'],
                ['Тенемимы', 7, 'Меняют спецсилу на любую видимую.', 'Small World: Underground'],
                ['Грибники', 5, 'Бонус за грибной лес.', 'Small World: Underground'],
                ['Паукоиды', 7, 'Считают пропасти смежными.', 'Small World: Underground'],
                ['Блуждающие Огни', 6, 'Кидают подкрепление до атаки кристаллов.', 'Small World: Underground'],
                ['Ящеролюды', 7, 'Проходят по реке без удержания жетонов.', 'Small World: Underground'],
                ['Личи', 5, 'Соперник платит при захвате их упадших регионов.', 'Small World: Underground'],
                ['Кракен', 5, 'Оставляет жетоны на реке и начисляет монеты.', 'Small World: Underground'],
            ];

            $abilities = [
                // Core game
                ['Алхимик', 4, 'Каждый ход +2 монеты.', 'Small World (base)'],
                ['Берсерк', 4, 'Бросок подкрепления перед каждой атакой.', 'Small World (base)'],
                ['Лагеря', 5, '5 укреплений по +1 к защите.', 'Small World (base)'],
                ['Коммандос', 4, 'Все захваты на 1 жетон дешевле.', 'Small World (base)'],
                ['Дипломат', 5, 'Выбираешь соседа, который не сможет атаковать тебя.', 'Small World (base)'],
                ['Повелитель Дракона', 5, 'Раз в ход драконовский захват за 1 жетон, регион становится неуязвим.', 'Small World (base)'],
                ['Летающие', 5, 'Можно захватывать любой регион.', 'Small World (base)'],
                ['Лесные', 4, '+1 монета за леса.', 'Small World (base)'],
                ['Укреплённые', 3, 'Крепость даёт +1 к защите и +1 монету.', 'Small World (base)'],
                ['Героические', 5, 'Два героических региона неуязвимы.', 'Small World (base)'],
                ['Холмистые', 4, '+1 монета за холмы.', 'Small World (base)'],
                ['Торговцы', 2, '+1 монета за каждый регион.', 'Small World (base)'],
                ['Всадники', 5, 'Холмы и поля на 1 дешевле.', 'Small World (base)'],
                ['Грабящие', 5, '+1 монета за каждый захваченный занятый регион.', 'Small World (base)'],
                ['Мореплаватели', 5, 'Захватывать и держать моря/озёра.', 'Small World (base)'],
                ['Духи', 5, 'Упадшая раса духов не занимает слот упадка.', 'Small World (base)'],
                ['Выносливые', 4, 'Можно уйти в упадок после обычного хода.', 'Small World (base)'],
                ['Болотные', 4, '+1 монета за болота.', 'Small World (base)'],
                ['Подземные', 5, 'Пещеры на 1 дешевле и все пещеры смежны.', 'Small World (base)'],
                ['Богатые', 4, 'Разово +7 монет в первый ход.', 'Small World (base)'],

                // A Spider's Web
                ['Подражатели', 3, 'В начале хода копируешь один из 6 видимых пауэров.', 'Small World: A Spider\'s Web'],
                ['Лава', 5, 'После хода кладёшь лаву от гор, блокируя регионы до твоего следующего хода.', 'Small World: A Spider\'s Web'],
                ['Прикосновение Душ', 4, 'Упадок оживляет предыдущую упавшую расу вместо взятия новой.', 'Small World: A Spider\'s Web'],

                // Be Not Afraid!
                ['Баррикады', 4, '+3 монеты, если в конце хода у тебя ≤4 региона.', 'Small World: Be Not Afraid!'],
                ['Катапульта', 4, 'Раз в ход дальний штурм через 1 регион, регион с катапультой неуязвим.', 'Small World: Be Not Afraid!'],
                ['Коррупция', 4, 'Соперники платят монету, когда берут твои активные регионы.', 'Small World: Be Not Afraid!'],
                ['Имперские', 4, '+1 монета за каждый регион сверх трёх.', 'Small World: Be Not Afraid!'],
                ['Наёмники', 4, 'Монетой уменьшаешь стоимость штурма на 2.', 'Small World: Be Not Afraid!'],

                // Grand Dames
                ['Историки', 5, 'Монеты за каждый упадок и за собственный упадок.', 'Small World: Grand Dames'],
                ['Миролюбивые', 4, '+3 монеты, если не атаковал активных.', 'Small World: Grand Dames'],

                // Cursed!
                ['Проклятые', 0, 'Чтобы пропустить комбо — платить 3 монеты вместо 1.', 'Small World: Cursed!'],
                ['Орды', 5, '2 жетона Орды как дополнительные боевые жетоны.', 'Small World: Cursed!'],
                ['Набеговые', 5, 'После первой серии захватов делаешь вторую.', 'Small World: Cursed!'],
                ['Разоряющие', 4, 'Соперник платит монету за занятый регион, который ты взял.', 'Small World: Cursed!'],
                ['Оборотни', 4, 'В чётные раунды все штурмы на 2 дешевле.', 'Small World: Cursed!'],

                // Royal Bonus
                ['Водные', 3, '+1 монета за прибрежные регионы, прочие приносят на 1 меньше.', 'Small World: Royal Bonus'],
                ['Бегемоты', 4, 'Два стак-юнита равны числу болот, считаются как войска.', 'Small World: Royal Bonus'],
                ['Огненные Шары', 5, 'Получаешь маркеры-огншары, каждый = 2 жетона на атаку.', 'Small World: Royal Bonus'],

                // Sky Islands
                ['Воздушные', 3, 'В ход выбора — все штурмы на 2 дешевле.', 'Small World: Sky Islands'],
                ['Исследователи', 5, 'Бонус равный меньшему из количеств регионов на земле/в небе.', 'Small World: Sky Islands'],
                ['Златокузнецы', 4, '+2 монеты за шахты, прочие регионы −1 монета.', 'Small World: Sky Islands'],
                ['Канониры', 3, '2 пушки: иммунитет региона и штурм соседей на −2.', 'Small World: Sky Islands'],
                ['Торгаши', 5, 'Договора торговли: платёж/штраф за атаки по тебе.', 'Small World: Sky Islands'],
                ['Рэкетиры', 5, 'Монеты за пропуски комбо другими; следующая раса бесплатно.', 'Small World: Sky Islands'],
                ['Дирижабли', 5, 'До 5 авиаштурмов с кубиком; риск пожара.', 'Small World: Sky Islands'],

                // Underground (все числа с бейджей)
                ['Искатели Приключений', 5, '+1 монета за каждый Регион с Знаковым Местом.', 'Small World: Underground'],
                ['Рыбаки', 4, '+1 за каждую пару прибрежных регионов у реки.', 'Small World: Underground'],
                ['Стая', 4, '+2 монеты, если все регионы образуют один массив.', 'Small World: Underground'],
                ['Пугливые', 4, '+1 монета за регионы с ≥3 твоими жетонами.', 'Small World: Underground'],
                ['Бессмертные', 4, 'Потери берёшь в руку вместо сброса одного.', 'Small World: Underground'],
                ['Мешок-всего-на-свете', 5, 'Копирует силу одного из реликтов в игре.', 'Small World: Underground'],
                ['Мученики', 4, '+1 монета, когда соперник берёт твой регион.', 'Small World: Underground'],
                ['Шахтёры', 4, '+1 монета за каждую шахту.', 'Small World: Underground'],
                ['Грязевые', 3, '+1 монета за грязь, работает и в упадке.', 'Small World: Underground'],
                ['Мистики', 4, '+1 монета за кристаллы.', 'Small World: Underground'],
                ['Ссорящиеся', 3, '+1 монета за каждый отдельный кластер регионов.', 'Small World: Underground'],
                ['Возрождённые', 5, 'В упадке заменяют 1–2 регионов новыми жетонами.', 'Small World: Underground'],
                ['Королевские', 5, 'Королева делает регион иммунным.', 'Small World: Underground'],
                ['Щитоносцы', 5, 'Грибные доспехи дают +1 к защите, можно держать на карте.', 'Small World: Underground'],
                ['Каменные', 5, '+1 монета за чёрные горы.', 'Small World: Underground'],
                ['Воры', 4, 'Соседи платят монету, если граничат с твоими регионами.', 'Small World: Underground'],
                ['Гробницы', 5, 'Все жетоны остаются при упадке и можно ещё раз их передвинуть.', 'Small World: Underground'],
                ['Вампиры', 5, 'Раз в ход на игрока заменяют одиночный вражеский жетон.', 'Small World: Underground'],
                ['Исчезающие', 5, 'В упадке оставляют по 2 монеты на регион вместо 1.', 'Small World: Underground'],
                ['Мстительные', 4, 'Маркер мести: атакующий платит завышенную цену на 1.', 'Small World: Underground'],
                ['Мудрые', 4, '+2 монеты, если в упадке держат ≥1 регион.', 'Small World: Underground'],
            ];

            $raceRows = [];
            foreach ($races as [$name, $qty, $desc, $ed]) {
                $raceRows[] = [
                    'name' => $name,
                    'qty' => $qty,
                    'description' => $desc,
                    'image' => null,
                    'edition_id' => $editionIds[$ed] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('smallworld.races')->insert($raceRows);

            $abilityRows = [];
            foreach ($abilities as [$name, $qty, $desc, $ed]) {
                $abilityRows[] = [
                    'name' => $name,
                    'qty' => $qty,
                    'description' => $desc,
                    'image' => null,
                    'edition_id' => $editionIds[$ed] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('smallworld.abilities')->insert($abilityRows);
        });
    }
}
