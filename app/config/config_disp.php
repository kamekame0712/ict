<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//**** 表示文言関連config ****

$config['disp'] = array(

	// 都道府県
	'pref' => array(
		''		=> '選択してください',
		'01'	=> '北海道',
		'02'	=> '青森県',
		'03'	=> '岩手県',
		'04'	=> '宮城県',
		'05'	=> '秋田県',
		'06'	=> '山形県',
		'07'	=> '福島県',
		'08'	=> '茨城県',
		'09'	=> '栃木県',
		'10'	=> '群馬県',
		'11'	=> '埼玉県',
		'12'	=> '千葉県',
		'13'	=> '東京都',
		'14'	=> '神奈川県',
		'15'	=> '新潟県',
		'16'	=> '富山県',
		'17'	=> '石川県',
		'18'	=> '福井県',
		'19'	=> '山梨県',
		'20'	=> '長野県',
		'21'	=> '岐阜県',
		'22'	=> '静岡県',
		'23'	=> '愛知県',
		'24'	=> '三重県',
		'25'	=> '滋賀県',
		'26'	=> '京都府',
		'27'	=> '大阪府',
		'28'	=> '兵庫県',
		'29'	=> '奈良県',
		'30'	=> '和歌山県',
		'31'	=> '鳥取県',
		'32'	=> '島根県',
		'33'	=> '岡山県',
		'34'	=> '広島県',
		'35'	=> '山口県',
		'36'	=> '徳島県',
		'37'	=> '香川県',
		'38'	=> '愛媛県',
		'39'	=> '高知県',
		'40'	=> '福岡県',
		'41'	=> '佐賀県',
		'42'	=> '長崎県',
		'43'	=> '熊本県',
		'44'	=> '大分県',
		'45'	=> '宮崎県',
		'46'	=> '鹿児島県',
		'47'	=> '沖縄県'
	),

	'form_type' => array(
		'1'		=> 'はじめてのオンライン学習',
		'2'		=> '英語4技能のデジタル化',
		'3'		=> '教室とご家庭をつなげるには'
	),

	'know' => array(
		'1'		=> '教材受取時',
		'5'		=> 'DM受取時',
		'2'		=> '当社営業訪問時',
		'3'		=> '教材展示会',
		'4'		=> 'セミナー',
		'9'		=> 'その他'
	),

	'flg_processed' => array(
		'1'		=> '未処理',
		'8'		=> 'キャンセル',
		'9'		=> '処理済'
	),

	'product'	=> array(
		'1'		=> array(
			''		=> '選択してください',
			'01'	=> 'ポイントレッスン（EN）',
			'02'	=> 'レクチャームービー（EN）',
			'03'	=> 'E-zo新演習（EN）',
			'04'	=> '映像○○シリーズ（好学）',
			'05'	=> '基本のキ（学書）',
			'06'	=> 'edu plus+  エデュプラス（学書）',
			'07'	=> 'マイスタディ',
			'08'	=> '学びエイドマスター',
			'09'	=> 'リカラボ（EN）',
			'10'	=> 'シャカケン（EN）',
			'11'	=> 'douga pocket（東書）',
			'12'	=> 'アルカ（学書）',
			'13'	=> 'エイタイ（EN）',
			'99'	=> 'その他'
		),
		'2'		=> array(
			''		=> '選択してください',
			'01'	=> 'あい・キャン　タッチペン（学書）',
			'02'	=> 'あい・キャン×englider（学書）',
			'03'	=> 'ELST（SINE WAVE）',
			'04'	=> 'MyET（好学）',
			'05'	=> 'デジタルドリル（学書）',
			'06'	=> 'Word Shower（好学）',
			'07'	=> 'デジタルブック（EN）',
			'08'	=> 'デジタル指導書（文理）',
			'09'	=> 'ＷＥＢブックシリーズ（好学）',
			'10'	=> 'デジタルブック（好学）',
			'11'	=> '学習塾用NEW HORIZON（東書）',
			'12'	=> 'D-EDU Book（学書）',
			'99'	=> 'その他'
		),
		'3'		=> array(
			''		=> '選択してください',
			'01'	=> 'CHALK Digital（Ｔ＆Ｋ）',
			'02'	=> '塾シル！（ユナイトプロジェクト）',
			'03'	=> 'オプティマスタディ（EN）',
			'04'	=> '受験コンパス（Lacicu）',
			'05'	=> '安心でんしょばと（LINES）',
			'06'	=> 'Comiru（POPER）',
			'99'	=> 'その他'
		)
	),

	'substance' => array(
		''		=> '選択してください',
		'1'		=> '商品説明',
		'2'		=> 'デモ希望',
		'3'		=> '導入相談',
		'4'		=> '契約申込み'
	),

	'method'	=> array(
		''		=> '選択してください',
		'1'		=> 'お電話',
		'2'		=> 'メール',
		'3'		=> 'Web会議（Zoom）',
		'4'		=> '営業訪問'
	),

	'flg_handle'	=> array(
		''		=> '選択してください',
		'1'		=> '未対応',
		'2'		=> 'OF案件管理',
		'3'		=> '対応済',
		'4'		=> '対応しない',
		'5'		=> 'キャンセル'
	),

);
