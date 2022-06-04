<?php
/**
 * 1-3. やってることをそれぞれ切り出す
 * ここからさらに、何をやっているかを切り出してわかりやすくしていきたいと思います。 
 *
 * ゲームでキャラクタが攻撃をしたときのダメージ量を計算するロジック
 * $playerArmPower：プレイヤー本体の攻撃力
 * $playerArmWeapon:プレイヤーの武器の攻撃力
 * $enemyBodyDefence：敵本体の防御力
 * $enemyArmorDefence：敵の防具の防御力
 */
function before($playerArmPower,$playerArmWeapon, $enemyBodyDefence, $enemyArmorDefence)
{
    // 与えるダメージの総量　←　あくまでこの定義でいていただいて
    $damageAmount = 0;
    // 与えるダメージの合計を出す　←　ここをちゃんと新しい変数で定義する
    $totalPlayerAttackPower = $playerArmPower + $playerArmWeapon;
    // 敵の防御力の合計を、与えるダメージから引いて、実際のダメージを出す ←　ここは一度与えるダメージを別で定義する
    $totalEnemyDefence = $enemyBodyDefence + $enemyArmorDefence;
    // ダメージ量を再度計算
    $damageAmount = $totalPlayerAttackPower - ($totalEnemyDefence/2);
    // ダメージ量はマイナスにはならないので調整
    if ($damageAmount < 0) {
        $damageAmount = 0;
    }
    return $damageAmount;
}

/**
 * 処理を関数に切り出しました。最後に余計なコメントアウトも消して、きれいにしたいと思います。
 */
function after($playerArmPower,$playerArmWeapon, $enemyBodyDefence, $enemyArmorDefence)
{
    // 与えるダメージの総量
    $damageAmount = 0;

    // 与えるダメージの合計を出す
    $totalPlayerAttackPower = sumUpPlayerAttackPower($playerArmPower, $playerArmWeapon);

    // 敵の防御力の合計を出す
    $totalEnemyDefence = sumUpEnemyDefence($enemyBodyDefence, $enemyArmorDefence);

    // ダメージ量を評価
    $damageAmount = estimateDamage($totalPlayerAttackPower, $totalEnemyDefence);

    return $damageAmount;
}

// では動作確認
// まあ結果は変わりませんが。。。でも圧倒的に見やすくなりました！
echo after(200,20,100,10);

/*
 * 与えるダメージの合計を出す
 * コピペで作るのが楽ですよね
 */
function sumUpPlayerAttackPower(int $playerArmPower, int $playerArmWeapon):int
{
    return $playerArmPower + $playerArmWeapon;
}

/**
 * 敵の防御力の合計を出す
 */
function sumUpEnemyDefence(int $enemyBodyDefence, int $enemyArmorDefence):int
{
    return $enemyBodyDefence + $enemyArmorDefence;  
}

/**
 * ダメージ量を評価する
 */
function estimateDamage(int $totalPlayerAttackPower, int $totalEnemyDefence):int
{
    $damageAmount = $totalPlayerAttackPower - ($totalEnemyDefence/2);
    // ダメージ量はマイナスにはならないので調整
    if ($damageAmount < 0) {
        $damageAmount = 0;
    }
    return $damageAmount;
}