<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateModels extends Command
{
    protected $signature = 'models:update-traits';
    protected $description = 'Add AutoIdManager trait to all models';

    public function handle()
    {
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

        $basePath = app_path('Models/');

        foreach ($models as $model) {
            $filePath = $basePath . $model;

            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);

                if (strpos($content, 'AutoIdManager') === false) {
                    // Add use statement
                    if (strpos($content, 'use App\Traits\AutoIdManager;') === false) {
                        $content = preg_replace(
                            '/(namespace App\\\\Models;)/s',
                            '$1' . "\n\nuse App\\Traits\\AutoIdManager;",
                            $content
                        );
                    }

                    // Add trait to class
                    if ($model === 'User.php') {
                        $content = preg_replace(
                            '/(use HasApiTokens, HasFactory, Notifiable)(;)/s',
                            '$1, AutoIdManager$2',
                            $content
                        );
                    } else {
                        $content = preg_replace(
                            '/(class \w+ extends Model\s*\{)/s',
                            '$1' . "\n    use AutoIdManager;\n",
                            $content
                        );
                    }

                    file_put_contents($filePath, $content);
                    $this->info("✅ Updated: {$model}");
                } else {
                    $this->line("⏭️ Skipped: {$model} (already has AutoIdManager)");
                }
            } else {
                $this->error("❌ Not found: {$model}");
            }
        }

        $this->info("\n🎉 Update complete! Running composer dump-autoload...");
        exec('composer dump-autoload');
        $this->info("✅ Autoload updated!");
    }
}
