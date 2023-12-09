SELECT
  CONCAT(w.first_name, ' ', w.last_name) as worker_full_name,
  GROUP_CONCAT(ch.name SEPARATOR ', ') as children_name,
  c.model as car_model
FROM
  worker w
  LEFT JOIN child ch ON (w.id = ch.user_id)
  LEFT JOIN car c ON (w.id = c.user_id)
WHERE
  c.model IS NOT NULL
GROUP BY
  w.id;
