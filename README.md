# 介護コミュニケーションアプリ CareChat
</br>
<img width="1079" alt="スクリーンショット 0004-12-27 14 55 14" src="https://user-images.githubusercontent.com/104340462/209618522-d106eeaf-6b13-4cef-8417-c138a179c5de.png">

## サービス概要
在宅の介護看護サービスを受ける際の情報共有を目的としたアプリ。患者の状態、介護家族の状況、働く側の状況の報告共有、連絡先、などを関わる全員が簡単に共有できる。

## 作成した目的
介護看護のサービスアプリは保険制度の処理をするためのものが多く、サービス利用者の家族や被介護者本人までが確認できるものが少ないため、情報の共有にサービス利用者がおいていかれてしまう現状がある。さらに、被介護者を実際に一番長く見ている家族が知っている情報で病気の予防や状態異常の早期発見などにつながる事が多いため、在宅介護看護サービスにおいて重要な情報が拾えない事が多々ある。介護看護サービス事業者が実際に被介護者と向き合える時間は週に平均数十分であり、その情報だけでは状態異常を見逃してしまい、悪化するケースも少なくない。この現状を打開するために、介護看護ステーションは独自に家族とコミュニケーションを取る方法をノートに記載したりなどしているが、チェックし忘れや書き忘れがおおくなる現状がある。さらに、サービス事業所が複数になる事もあるため、事業所間での情報の共有も遅れる事が多いため、事業所間の情報共有もまとめて可能とする。

## 他リポジトリ
フロントエンド
https://github.com/masanarimiura/care-chat-nuxtjs-github-pj.git

バックエンド
https://github.com/masanarimiura/care-chat-laravel-github-pj.git


## 機能一覧
新規クライアントアカウント登録
クライアント情報の取得
新規ケアワーカーアカウント登録
ケアワーカー情報の取得
firebaseにてアカウント登録
firebaseにてメール認証
firebaseにてログイン
firebaseにてログインチェック
firebaseにてメールアドレス変更
ログインチェック時にアカウント情報取得、保持
firebaseにてログアウト
ログアウト時にvuexのアカウント情報の破棄
チャットIDの作成
チャットへ作成した際に中間テーブルへ履歴登録
作成したことのあるチャットIDの表示
チャット作成時のチャットIDの情報保持
チャットIDへの参加
チャットへ参加した際に中間テーブルへ履歴登録
参加したことのあるチャットIDの表示
チャット参加中のチャットIDの情報保持
チャットでコメントの投稿
チャットでコメントの更新
チャットでコメントの削除
クライアントマイページのお名前更新
クライアントマイページのメールアドレス更新
クライアントマイページの電話番号登録
クライアントマイページの電話番号更新
クライアントマイページの電話番号削除
クライアントマイページの関係性登録
クライアントマイページの関係性更新
ケアワーカーマイページのお名前更新
ケアワーカーマイページのメールアドレス更新
ケアワーカーマイページの電話番号登録
ケアワーカーマイページの電話番号更新
ケアワーカーマイページの電話番号削除
ケアワーカーマイページの職種登録
ケアワーカーマイページの職種更新
ケアワーカーマイページの事業所情報登録
ケアワーカーマイページの事業所情報更新
ケアワーカーの新規事業所登録


## 使用技術
Nuxt.js nuxt@2.15.8
Laravel Framework 8.83.23

## テーブル設計
</br>
<img width="336" alt="スクリーンショット 0004-08-30 13 43 57" src="https://user-images.githubusercontent.com/104340462/187351107-055d3e58-3248-4f50-9752-0a7dda920ab6.png">

## ER図
</br>
<img width="563" alt="スクリーンショット 0004-08-30 13 51 16" src="https://user-images.githubusercontent.com/104340462/187351884-f4ecc13f-25da-482c-a432-95622922529e.png">
