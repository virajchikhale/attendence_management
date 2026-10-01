-- Dummy attendance data for demos and testing (PostgreSQL)
--
-- Adds one lecture per subject per weekday (Mon-Sat) for the last 8 weeks, with
-- randomised present/absent marks for the students of each subject's classes.
-- Every student gets a different attendance rate, so reports show a spread of
-- percentages. Run it on top of database/student_management.sql.
--
-- Safe to re-run: it replaces rows it created earlier (attendence.id >= 1000)
-- and leaves the original sample rows alone.
--
--   docker compose exec -T db psql -U attendance student_management < database/seed_dummy_data.sql

DO $$
DECLARE
  weeks      constant integer := 8;
  first_id   constant integer := 1000;
  next_id    integer := first_id;
  day        date;
  subj       record;
  enrolled   integer[];
  n          integer;
  mark       integer;
  col_list   text;
  val_list   text;
BEGIN
  DELETE FROM attendence WHERE id >= first_id;

  FOR day IN
    SELECT d::date FROM generate_series(current_date - weeks * 7, current_date - 1, interval '1 day') AS d
    WHERE extract(dow FROM d) <> 0
  LOOP
    FOR subj IN
      -- Subjects with year 0 are not tied to a class, so there is nobody to mark
      SELECT id, department_id, year, row_number() OVER (ORDER BY id) AS slot
      FROM subject WHERE year > 0 ORDER BY id
    LOOP
      SELECT array_agg(s.enroll::integer) INTO enrolled
      FROM student s
      JOIN class c ON c.id = s.class_id
      WHERE c.department_id = subj.department_id AND c.year = subj.year
        AND s.enroll ~ '^[0-9]+$' AND s.enroll::integer BETWEEN 1 AND 100;

      CONTINUE WHEN enrolled IS NULL;

      col_list := '';
      val_list := '';
      FOR n IN 1..100 LOOP
        IF n = ANY (enrolled) THEN
          -- Per-student attendance rate between 50% and 95%
          mark := CASE WHEN random() < 0.5 + 0.45 * ((n * 37) % 100) / 100.0 THEN 1 ELSE 0 END;
        ELSE
          mark := -1;
        END IF;
        col_list := col_list || format(', "S_%s"', n);
        val_list := val_list || format(', %s', mark);
      END LOOP;

      EXECUTE format(
        'INSERT INTO attendence (id, date, time, subject%s) VALUES (%s, %L, %L, %s%s)',
        col_list, next_id, day, make_time(8 + subj.slot::integer, 0, 0), subj.id, val_list
      );
      next_id := next_id + 1;
    END LOOP;
  END LOOP;

  PERFORM setval(pg_get_serial_sequence('attendence', 'id'), (SELECT MAX(id) FROM attendence));
  RAISE NOTICE 'Seeded % attendance records', next_id - first_id;
END
$$;
