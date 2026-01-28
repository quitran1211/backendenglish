<?php

namespace App\Console\Commands;

use App\Services\Chatbot\RAGService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class IndexDataCommand extends Command
{
    protected $signature = 'chatbot:index {--clear : Clear existing data first}';

    protected $description = 'Index data into RAG vector database';

    private RAGService $ragService;

    public function __construct(RAGService $ragService)
    {
        parent::__construct();
        $this->ragService = $ragService;
    }

    public function handle(): int
    {
        $this->info('🚀 Starting data indexing...');

        try {
            // Initialize RAG
            $this->info('🔧 Initializing RAG Service...');
            $this->ragService->initialize();

            // Clear existing data if flag is set
            if ($this->option('clear')) {
                $this->warn('🗑️  Clearing existing data...');
                // TODO: Add clear method to RAGService
            }

            // Index lessons
            $this->indexLessons();

            // Index strategies
            $this->indexStrategies();

            // Show stats
            $stats = $this->ragService->getStats();
            $this->info("\n✅ Indexing complete!");
            $this->info('📊 Total documents: '.$stats['totalDocuments']);

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Indexing failed: '.$e->getMessage());

            return Command::FAILURE;
        }
    }

    /**
     * Index lessons from database
     */
    private function indexLessons(): void
    {
        $this->info("\n📚 Indexing lessons...");

        $lessons = DB::table('lessons')->get();

        if ($lessons->isEmpty()) {
            $this->warn('⚠️  No lessons found in database');

            return;
        }

        $documents = $lessons->map(function ($lesson) {
            return [
                'content' => trim("
Tiêu đề: {$lesson->title}
Loại: {$lesson->lesson_type}
Mô tả: ".($lesson->description ?? '')."
Nội dung: {$lesson->content}
                "),
                'metadata' => [
                    'id' => $lesson->id,
                    'type' => 'lesson',
                    'title' => $lesson->title,
                    'lesson_type' => $lesson->lesson_type,
                ],
            ];
        })->toArray();

        $bar = $this->output->createProgressBar(count($documents));
        $bar->start();

        // Index in batches of 10
        $chunks = array_chunk($documents, 10);
        foreach ($chunks as $chunk) {
            $this->ragService->addDocuments($chunk);
            $bar->advance(count($chunk));
        }

        $bar->finish();
        $this->info("\n✅ Indexed ".count($documents).' lessons');
    }

    /**
     * Index TOEIC strategies
     */
    private function indexStrategies(): void
    {
        $this->info("\n💡 Indexing TOEIC strategies...");

        $strategies = [
            [
                'content' => <<<'TEXT'
CHIẾN LƯỢC PART 1 - PHOTOGRAPHS

Kỹ thuật:
1. Nhìn kỹ ảnh trước khi nghe (5 giây)
2. Xác định: Người - Vật - Hành động - Vị trí
3. Chú ý thì của động từ
4. Loại trừ đáp án sai rõ ràng

Lưu ý:
- Cẩn thận với âm giống nhau (sound-alike)
- "He's wearing glasses" ≠ "There are glasses on the table"
- "She's walking" ≠ "She's working"

Thời gian: 5 giây/câu
Mục tiêu: 6/6 câu đúng
TEXT,
                'metadata' => [
                    'type' => 'strategy',
                    'part' => 'Part 1',
                    'title' => 'Chiến lược Part 1 - Photographs',
                ],
            ],
            [
                'content' => <<<'TEXT'
CHIẾN LƯỢC PART 5 - INCOMPLETE SENTENCES

Các bước làm bài:
1. Đọc câu hoàn chỉnh (không nhìn đáp án trước)
2. Xác định loại từ cần điền (N/V/Adj/Adv)
3. Chú ý ngữ pháp:
   - Thì (tense)
   - Giới từ (preposition)
   - Liên từ (conjunction)
   - Subject-verb agreement
4. Loại trừ đáp án sai
5. Chọn đáp án đúng nhất

Điểm nhấn:
✓ Collocations phổ biến
✓ Phrasal verbs
✓ Word family (happy → happiness → happily)
✓ Cụm từ cố định

Thời gian: 30 giây/câu
Mục tiêu: 30 câu trong 10 phút
TEXT,
                'metadata' => [
                    'type' => 'strategy',
                    'part' => 'Part 5',
                    'title' => 'Chiến lược Part 5',
                ],
            ],
            [
                'content' => <<<'TEXT'
CHIẾN LƯỢC PART 7 - READING COMPREHENSION

Kỹ thuật hiệu quả:
1. ĐỌC CÂU HỎI TRƯỚC (keyword important!)
2. Gạch chân từ khóa
3. Skim bài đọc để định vị thông tin
4. Scan chi tiết khi cần
5. Đối chiếu với đáp án

Tips quan trọng:
- Chú ý: Tiêu đề, Tác giả, Ngày tháng, Địa điểm
- Tìm synonyms và paraphrases
- Đọc câu trước và sau vị trí thông tin
- ĐỪNG đọc hết bài (waste time!)

Phân bổ thời gian:
- Single passage: 2-3 phút
- Double passage: 4-5 phút
- Triple passage: 6-8 phút

Mục tiêu: 80% accuracy
TEXT,
                'metadata' => [
                    'type' => 'strategy',
                    'part' => 'Part 7',
                    'title' => 'Chiến lược Part 7',
                ],
            ],
            [
                'content' => <<<'TEXT'
TIPS CHUNG CHO TOEIC

CHUẨN BỊ TRƯỚC KHI THI:
✓ Học 20-30 từ vựng mỗi ngày
✓ Luyện nghe ít nhất 30 phút/ngày
✓ Làm mini test hàng tuần
✓ Review sai lầm thường xuyên
✓ Luyện cả 4 kỹ năng đều đặn

TRONG KHI THI:
✓ Quản lý thời gian chặt chẽ
✓ Đừng mắc kẹt ở câu khó → Skip!
✓ Đoán thông minh nếu không biết
✓ Giữ bình tĩnh và tập trung
✓ Check lại đáp án nếu còn thời gian

LỘ TRÌNH THEO ĐIỂM:
- 400-500 (Beginner): Focus ngữ pháp cơ bản, từ vựng thiết yếu
- 500-650 (Intermediate): Mở rộng vocab, luyện tốc độ
- 650-800 (Advanced): Perfect grammar, tăng accuracy
- 800+ (Expert): Native-like, strategic guessing

KẾ HOẠCH HỌC:
- 3 tháng: +100 điểm
- 6 tháng: +200 điểm
- 1 năm: +300-400 điểm
TEXT,
                'metadata' => [
                    'type' => 'tips',
                    'part' => 'General',
                    'title' => 'Tips tổng quát',
                ],
            ],
        ];

        $this->ragService->addDocuments($strategies);
        $this->info('✅ Indexed '.count($strategies).' strategies');
    }
}
