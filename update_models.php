<?php
// File: update_models.php (di root folder)

$models = [
    'AssignClassTeacherModel.php',
    'ClassModel.php',
    'ChatModel.php',
    'NoticeBoardMessageModel.php',
    'MarksRegisterModel.php',
    'MarksGradeModel.php',
    'WeekModel.php',
    'User.php',
    'SubjectModel.php',
    'StudentAttendanceModel.php',
    'SettingModel.php',
    'NoticeBoardModel.php',
    'HomeworkSubmitModel.php',
    'HomeworkModel.php',
    'ExamScheduleModel.php',
    'ExamModel.php',
    'ClassSubjectTimetableModel.php',
    'ClassSubjectModel.php'
];

$basePath = __DIR__ . '/app/Models/';

foreach ($models as $model) {
    $filePath = $basePath . $model;

    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);

        // Cek apakah sudah ada AutoIdManager
        if (strpos($content, 'AutoIdManager') === false) {
            // Tambahkan use statement
            if (strpos($content, 'use App\Traits\AutoIdManager;') === false) {
                // Cari posisi setelah namespace
                $content = preg_replace(
                    '/(namespace App\\\\Models;)/s',
                    '$1' . "\n\nuse App\\Traits\\AutoIdManager;",
                    $content
                );
            }

            // Tambahkan trait di dalam class
            if ($model === 'User.php') {
                // Untuk User model yang extend Authenticatable
                $content = preg_replace(
                    '/(use HasApiTokens, HasFactory, Notifiable)(;)/s',
                    '$1, AutoIdManager$2',
                    $content
                );
            } else {
                // Untuk model biasa yang extend Model
                $content = preg_replace(
                    '/(class \w+ extends Model\s*\{)/s',
                    '$1' . "\n    use AutoIdManager;\n",
                    $content
                );
            }

            file_put_contents($filePath, $content);
            echo "✅ Updated: {$model}\n";
        } else {
            echo "⏭️ Skipped: {$model} (already has AutoIdManager)\n";
        }
    } else {
        echo "❌ Not found: {$model}\n";
    }
}

echo "\n🎉 Update complete! Don't forget to run: composer dump-autoload\n";
