CREATE TABLE `t_admin` (
  `admin_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `email` varchar(256) DEFAULT NULL COMMENT 'メールアドレス',
  `password` varchar(256) NOT NULL COMMENT 'パスワード',
  `name` varchar(128) NOT NULL COMMENT '管理者名',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (admin_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_apply` (
  `apply_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(1) NOT NULL COMMENT 'フォーム番号',
  `juku_name` varchar(128) NOT NULL COMMENT '塾名',
  `contact_name` varchar(128) NOT NULL COMMENT 'お名前',
  `position` varchar(64) DEFAULT NULL COMMENT '役職',
  `zip` varchar(16) NOT NULL COMMENT '郵便番号',
  `pref` varchar(2) NOT NULL COMMENT '都道府県',
  `addr1` varchar(128) NOT NULL COMMENT '住所1',
  `addr2` varchar(128) NOT NULL COMMENT '住所2',
  `tel` varchar(16) NOT NULL COMMENT '電話番号',
  `email` varchar(256) NOT NULL COMMENT 'Eメールアドレス',
  `know` varchar(1) NOT NULL COMMENT 'いつ知ったか',
  `other` varchar(128) DEFAULT NULL COMMENT 'その他の詳細',
  `flg_processed` varchar(1) DEFAULT '1' COMMENT '処理済みフラグ 1:未処理 8:キャンセル 9:処理済み',
  `param` varchar(32) DEFAULT NULL COMMENT '問い合わせパラメーター',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (apply_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_consult` (
  `consult_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `apply_id` int(7) NOT NULL COMMENT 't_applyのID',
  `type` varchar(1) NOT NULL COMMENT 'フォーム番号',
  `juku_name` varchar(128) NOT NULL COMMENT '塾名',
  `product` varchar(2) NOT NULL COMMENT '商品番号',
  `other_product` varchar(128) DEFAULT NULL COMMENT '手入力の商品名',
  `substance` varchar(1) NOT NULL COMMENT 'ご相談内容',
  `hope_date` varchar(1) NOT NULL COMMENT 'ご相談日程',
  `other_hope_date` varchar(64) DEFAULT NULL COMMENT '手入力のご相談日程',
  `hope_time` varchar(64) DEFAULT NULL COMMENT 'ご希望時間',
  `method` varchar(1) NOT NULL COMMENT 'ご相談方法',
  `note` text COMMENT 'その他',
  `of_link` varchar(1) DEFAULT '1' COMMENT 'OF管理との連携 1:未 2:済',
  `flg_handle` varchar(1) DEFAULT '1' COMMENT '対応 1:未 2:OF管理 3:対応済 4:対応しない 5:キャンセル',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (consult_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_referer` (
  `referer_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(2) NOT NULL COMMENT 'フォーム番号 11:学習請求,12:4技能請求,21:学習問合,22:4技能問合',
  `remote_addr` varchar(64) DEFAULT NULL COMMENT '$_SERVER[REMOTE_ADDR]',
  `user_agent` varchar(256) DEFAULT NULL COMMENT '$_SERVER[HTTP_USER_AGENT]',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (referer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `t_admin` (`admin_id`, `email`, `password`, `name`, `regist_time`, `update_time`, `status`) VALUES
(1, 's-kamei@chuoh-kyouiku.co.jp', '$2y$10$2AFuHynXLWvvFkKVvTWgvOlurBmX78TlM/Cxup6Pj0gzfp1Xxc3ai', '亀井 伸一郎', '2020-12-02 12:00:00', '2020-12-02 12:00:00', '0');
