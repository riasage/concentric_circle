<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Community Map</title>
<link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<div class="wrap">
  <div class="panel">
    <h1>Community Map</h1>
    <p class="muted">Add people below. Data is stored in your database.</p>
    <form id="person-form">
      <label>
        Display name
        <input name="display_name" required>
      </label>
      <label>
        Locality
        <input name="locality">
      </label>
      <label>
        Quadrant
        <select name="quadrant">
          <option value="study">Study</option>
          <option value="devotional">Devotional</option>
          <option value="childrens">Childrens</option>
          <option value="jyp">JYP</option>
        </select>
      </label>
      <label class="checkbox">
        <input type="checkbox" name="is_core">
        Core person
      </label>
      <button type="submit">Add Person</button>
      <div id="status" class="status" aria-live="polite"></div>
    </form>
  </div>
  <div class="panel">
    <h2>People</h2>
    <ul id="people-list" class="list"></ul>
  </div>
  <div class="panel map">
    <h2>Map</h2>
    <svg id="map" viewBox="0 0 1000 600"></svg>
  </div>
</div>
<script src="assets/app.js"></script>
</body>
</html>
