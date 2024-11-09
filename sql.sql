SELECT
	`colleges`.`id` AS `id`,
	`colleges`.`course` AS `course`,
	`colleges`.`user_name` AS `user_name`,
	`colleges`.`inst_name` AS `inst_name`,
	sum( `colleges`.`intake` ) AS `total_intake`,(
	SELECT
		count( `allotment_lists`.`id` )
	FROM
		`allotment_lists`
	WHERE
		((
				`allotment_lists`.`user_name` = `colleges`.`user_name`
				)
		AND ( `allotment_lists`.`deleted_at` IS NULL ))) AS `total_allotted`,(
	SELECT
		count( `allotment_lists`.`id` )
	FROM
		`allotment_lists`
	WHERE
		((
				`allotment_lists`.`user_name` = `colleges`.`user_name`
				)
			AND ( `allotment_lists`.`round` = 'FU' )
			AND `allotment_lists`.`roll_number` IN (
			SELECT
				`students`.`roll_number`
			FROM
				`students`
			WHERE
				((
						`students`.`institute_user_name` = `colleges`.`user_name`
						)
					AND (
					`students`.`round` IN ( 'FU', 'SL' ))
				AND ( `students`.`deleted_at` IS NULL ))) IS FALSE
		AND ( `allotment_lists`.`deleted_at` IS NULL ))) AS `total_upgraded_admission_cancelled`,
	sum( `colleges`.`nri_seats` ) AS `total_nri`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`institute_user_name` = `colleges`.`user_name`
				)
			AND ( `students`.`round` = 'IPS' )
		AND ( `students`.`deleted_at` IS NULL ))) AS `total_ips`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`institute_user_name` = `colleges`.`user_name`
				)
			AND ( `students`.`tuition_fee_waiver_status` = 'Y' )
		AND ( `students`.`deleted_at` IS NULL ))) AS `total_tfw`,
	'0' AS `total_pio`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`round` = 'FU'
				)
			AND ( `students`.`tuition_fee_waiver_status` = 'N' )
			AND ( `students`.`institute_user_name` = `colleges`.`user_name` )
			AND `students`.`roll_number` IN (
			SELECT
				`transactions`.`counselling_id_roll_no`
			FROM
				`transactions`
			WHERE
				((
						`transactions`.`transaction_amount` = '1030'
						)
				AND ( `transactions`.`deleted_at` IS NULL )))
		AND ( `students`.`deleted_at` IS NULL ))) AS `total_upgrade_count`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`round` = 'FU'
				)
			AND ( `students`.`tuition_fee_waiver_status` = 'N' )
			AND ( `students`.`institute_user_name` = `colleges`.`user_name` )
			AND `students`.`roll_number` IN (
			SELECT
				`transactions`.`counselling_id_roll_no`
			FROM
				`transactions`
			WHERE
				((
						`transactions`.`transaction_amount` = '1030'
						)
				AND ( `transactions`.`deleted_at` IS NULL )))
		AND ( `students`.`deleted_at` IS NULL ))) AS `total_upgrade_allotment`,(
	SELECT
		( `total_upgrade_count` - `total_upgrade_allotment` )) AS `total_upgrade`,(
	SELECT
		count( `transactions`.`id` )
	FROM
		`transactions`
	WHERE
		((
				`transactions`.`transaction_amount` = 30
				)
			AND `transactions`.`counselling_id_roll_no` IN (
			SELECT
				`students`.`roll_number`
			FROM
				`students`
			WHERE
				((
						`students`.`institute_user_name` = `colleges`.`user_name`
						)
				AND ( `students`.`round` = 'CLC' )))
		AND ( `transactions`.`deleted_at` IS NULL ))) AS `total_clc_cancelled`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`institute_user_name` = `colleges`.`user_name`
				)
			AND ( `students`.`not_eligible` = 1 )
		AND ( `students`.`deleted_at` IS NULL ))) AS `total_nenv`,(
	SELECT
		sum( `colleges`.`total_admitted` )) AS `totalAdmission`,(
	SELECT
	( sum( `colleges`.`total_admitted` ) + `total_nenv` )) AS `total_admission`,
	`colleges`.`year` AS `year`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`institute_user_name` = `colleges`.`user_name`
				)
			AND (
			`students`.`round` IN ( 'FR', 'RF', 'F' ))
		AND ( `students`.`deleted_at` IS NULL ))) AS `fr_admission`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`institute_user_name` = `colleges`.`user_name`
				)
			AND (
			`students`.`round` IN ( 'SR', 'RS', 'S' ))
		AND ( `students`.`deleted_at` IS NULL ))) AS `sr_admission`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`institute_user_name` = `colleges`.`user_name`
				)
			AND ( `students`.`round` = 'SL' )
		AND ( `students`.`deleted_at` IS NULL ))) AS `sl_admission`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`institute_user_name` = `colleges`.`user_name`
				)
			AND ( `students`.`round` = 'FU' )
		AND ( `students`.`deleted_at` IS NULL ))) AS `fu_admission`,(
	SELECT
		count( `students`.`id` )
	FROM
		`students`
	WHERE
		((
				`students`.`institute_user_name` = `colleges`.`user_name`
				)
			AND (
			`students`.`round` IN ( 'TR', 'T' ))
		AND ( `students`.`deleted_at` IS NULL ))) AS `ql_admission`,(
	SELECT
		count( `allotment_lists`.`id` )
	FROM
		`allotment_lists`
	WHERE
		((
				`allotment_lists`.`user_name` = `colleges`.`user_name`
				)
			AND (
			`allotment_lists`.`round` IN ( 'FR', 'RF', 'F' ))
		AND ( `allotment_lists`.`deleted_at` IS NULL ))) AS `fr_allotment`,(
	SELECT
		count( `allotment_lists`.`id` )
	FROM
		`allotment_lists`
	WHERE
		((
				`allotment_lists`.`user_name` = `colleges`.`user_name`
				)
			AND (
			`allotment_lists`.`round` IN ( 'SR', 'RS', 'S' ))
		AND ( `allotment_lists`.`deleted_at` IS NULL ))) AS `sr_allotment`,(
	SELECT
		count( `allotment_lists`.`id` )
	FROM
		`allotment_lists`
	WHERE
		((
				`allotment_lists`.`user_name` = `colleges`.`user_name`
				)
			AND ( `allotment_lists`.`round` = 'SL' )
		AND ( `allotment_lists`.`deleted_at` IS NULL ))) AS `sl_allotment`,(
	SELECT
		count( `allotment_lists`.`id` )
	FROM
		`allotment_lists`
	WHERE
		((
				`allotment_lists`.`user_name` = `colleges`.`user_name`
				)
			AND ( `allotment_lists`.`round` = 'FU' )
		AND ( `allotment_lists`.`deleted_at` IS NULL ))) AS `ur_allotment`,(
	SELECT
		count( `allotment_lists`.`id` )
	FROM
		`allotment_lists`
	WHERE
		((
				`allotment_lists`.`user_name` = `colleges`.`user_name`
				)
			AND (
			`allotment_lists`.`round` IN ( 'TR', 'T', 'QR' ))
		AND ( `allotment_lists`.`deleted_at` IS NULL ))) AS `ql_allotment`,(
	SELECT
		((((
						`fr_allotment` - `fr_admission`
					) + ( `sr_allotment` - `sr_admission` )) + ( `sl_allotment` - `sl_admission` )) + ( `ql_allotment` - `ql_admission` ))) AS `total_admission_cancelled`,(
	SELECT
		((
				sum( `colleges`.`total_admitted` ) + `total_nenv`
			) - ((((( sum( `colleges`.`nri_seats` ) + `total_ips` ) + `total_clc_cancelled` ) + `total_nenv` ) + `total_upgrade_count` ) + `total_tfw` ))) AS `admission1`,(
	SELECT
		((((
						sum( `colleges`.`total_admitted` ) + `total_nenv`
						) + `total_upgrade_count`
					) + `total_upgrade_allotment`
			) - ((((( sum( `colleges`.`nri_seats` ) + `total_ips` ) + `total_clc_cancelled` ) + `total_nenv` ) + `total_upgrade_count` ) + `total_tfw` ))) AS `admission2`,(
	SELECT
		(((((
							sum( `colleges`.`total_admitted` ) + `total_nenv`
							) + `total_upgrade_count`
						) + `total_upgrade_allotment`
					) - ((((( sum( `colleges`.`nri_seats` ) + `total_ips` ) + `total_clc_cancelled` ) + `total_nenv` ) + `total_upgrade_count` ) + `total_tfw` )) * 1000
		)) AS `tuition_fee_payment`,(
	SELECT
		group_concat( `college_account_details`.`account_number` SEPARATOR ',' )
	FROM
		`college_account_details`
	WHERE
		( `college_account_details`.`user_name` = `colleges`.`user_name` )) AS `account_number`,(
	SELECT
		group_concat( `college_account_details`.`account_holder_name` SEPARATOR ',' )
	FROM
		`college_account_details`
	WHERE
		( `college_account_details`.`user_name` = `colleges`.`user_name` )) AS `account_holder_name`,(
	SELECT
		group_concat( `college_account_details`.`bank` SEPARATOR ',' )
	FROM
		`college_account_details`
	WHERE
		( `college_account_details`.`user_name` = `colleges`.`user_name` )) AS `bank`,(
	SELECT
		group_concat( `college_account_details`.`branch` SEPARATOR ',' )
	FROM
		`college_account_details`
	WHERE
		( `college_account_details`.`user_name` = `colleges`.`user_name` )) AS `bank_branch`,(
	SELECT
		group_concat( `college_account_details`.`ifsc` SEPARATOR ',' )
	FROM
		`college_account_details`
	WHERE
		( `college_account_details`.`user_name` = `colleges`.`user_name` )) AS `ifsc`,(
	SELECT
		group_concat( `college_account_details`.`nodal_officer_mobile_no` SEPARATOR ',' )
	FROM
		`college_account_details`
	WHERE
		( `college_account_details`.`user_name` = `colleges`.`user_name` )) AS `nodal_officer_mobile_no`,(
	SELECT
		group_concat( `college_account_details`.`asstt_nodal_officer_mobile_no` SEPARATOR ',' )
	FROM
		`college_account_details`
	WHERE
	( `college_account_details`.`user_name` = `colleges`.`user_name` )) AS `asstt_nodal_officer_mobile_no`
FROM
	`colleges`
WHERE
	( `colleges`.`deleted_at` IS NULL )
GROUP BY
	`colleges`.`user_name`
ORDER BY
	`colleges`.`user_name`,
	`colleges`.`course`
