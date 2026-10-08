<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tiny Progress Bar</title>
</head>
<body>

<div style="display: flex; align-items: center; gap: 12px" class="progressBarContainer">
    <div class="progressBar">
        <div class="progressFill"></div>
    </div>
    <span style="font-size: 0.85rem; font-weight: 500;">65%</span>
</div>

<script>
    function setProgress(percent) {
        document.getElementById('my-bar').style.width = percent + '%';
        document.getElementById('my-text').textContent = percent + '%';
    }
</script>

</body>
</html>