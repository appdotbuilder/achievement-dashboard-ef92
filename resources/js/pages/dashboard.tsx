import AppLayout from '@/components/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Achievement {
    id: number;
    title: string;
    value: number;
    target_value?: number;
    unit?: string;
    category?: string;
    color?: string;
    percentage?: number;
}

interface DashboardContent {
    id: number;
    title: string;
    content_type: string;
    content?: string;
    background_color?: string;
    text_color?: string;
}

interface Presentation {
    id: number;
    title: string;
    total_slides: number;
    thumbnail_path?: string;
    user_name: string;
    created_at: string;
}

interface Props {
    achievements: Achievement[];
    content: DashboardContent[];
    presentations: Presentation[];
    stats: {
        total_achievements: number;
        total_content: number;
        total_presentations: number;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ achievements, content, presentations, stats }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        📊 Dashboard Overview
                    </h1>
                    <div className="flex gap-2">
                        <Link
                            href={route('achievements.create')}
                            className="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
                        >
                            📈 Add Achievement
                        </Link>
                        <Link
                            href={route('presentations.create')}
                            className="inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700"
                        >
                            🎨 Upload Presentation
                        </Link>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="text-3xl">📈</div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Achievements
                                </p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {stats.total_achievements}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="text-3xl">📰</div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Active Content
                                </p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {stats.total_content}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="text-3xl">🎨</div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Presentations
                                </p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {stats.total_presentations}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="text-3xl">🔄</div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Last Sync
                                </p>
                                <p className="text-sm font-bold text-gray-900 dark:text-white">
                                    2 minutes ago
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="grid gap-6 lg:grid-cols-2">
                    {/* Achievements Section */}
                    <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                        <div className="mb-4 flex items-center justify-between">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                📈 Recent Achievements
                            </h2>
                            <Link
                                href={route('achievements.index')}
                                className="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400"
                            >
                                View all →
                            </Link>
                        </div>
                        
                        <div className="space-y-4">
                            {achievements.slice(0, 4).map((achievement) => (
                                <div
                                    key={achievement.id}
                                    className="flex items-center justify-between rounded-lg border p-4 dark:border-gray-700"
                                    style={{
                                        backgroundColor: achievement.color ? `${achievement.color}15` : undefined,
                                    }}
                                >
                                    <div>
                                        <h3 className="font-medium text-gray-900 dark:text-white">
                                            {achievement.title}
                                        </h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            {achievement.category}
                                        </p>
                                    </div>
                                    <div className="text-right">
                                        <div className="text-lg font-bold text-gray-900 dark:text-white">
                                            {achievement.value.toLocaleString()}{achievement.unit}
                                        </div>
                                        {achievement.percentage && (
                                            <div className="text-sm text-gray-600 dark:text-gray-400">
                                                {achievement.percentage}% of target
                                            </div>
                                        )}
                                    </div>
                                </div>
                            ))}
                        </div>
                        
                        {achievements.length === 0 && (
                            <div className="py-8 text-center text-gray-500 dark:text-gray-400">
                                <div className="text-4xl">📊</div>
                                <p className="mt-2">No achievements yet</p>
                                <Link
                                    href={route('achievements.create')}
                                    className="mt-2 inline-block text-blue-600 hover:text-blue-800 dark:text-blue-400"
                                >
                                    Create your first achievement →
                                </Link>
                            </div>
                        )}
                    </div>

                    {/* Dynamic Content Section */}
                    <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                        <div className="mb-4 flex items-center justify-between">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                📰 Dynamic Content
                            </h2>
                            <button className="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                Manage content →
                            </button>
                        </div>
                        
                        <div className="space-y-4">
                            {content.slice(0, 3).map((item) => (
                                <div
                                    key={item.id}
                                    className="rounded-lg border p-4 dark:border-gray-700"
                                    style={{
                                        backgroundColor: item.background_color || undefined,
                                        color: item.text_color || undefined,
                                    }}
                                >
                                    <h3 className="font-medium">{item.title}</h3>
                                    <p className="mt-1 text-sm opacity-90">
                                        {item.content && item.content.length > 100
                                            ? `${item.content.slice(0, 100)}...`
                                            : item.content}
                                    </p>
                                    <span className="mt-2 inline-block rounded-full bg-black bg-opacity-10 px-2 py-1 text-xs">
                                        {item.content_type}
                                    </span>
                                </div>
                            ))}
                        </div>
                        
                        {content.length === 0 && (
                            <div className="py-8 text-center text-gray-500 dark:text-gray-400">
                                <div className="text-4xl">📝</div>
                                <p className="mt-2">No content items yet</p>
                                <button className="mt-2 text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                    Add content →
                                </button>
                            </div>
                        )}
                    </div>
                </div>

                {/* Presentations Section */}
                <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                    <div className="mb-4 flex items-center justify-between">
                        <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                            🎨 Recent Presentations
                        </h2>
                        <Link
                            href={route('presentations.index')}
                            className="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400"
                        >
                            View all →
                        </Link>
                    </div>
                    
                    <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        {presentations.map((presentation) => (
                            <Link
                                key={presentation.id}
                                href={route('presentations.show', presentation.id)}
                                className="group rounded-lg border p-4 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-700"
                            >
                                <div className="mb-3 aspect-video rounded bg-gray-100 dark:bg-gray-700">
                                    {presentation.thumbnail_path ? (
                                        <img
                                            src={presentation.thumbnail_path}
                                            alt={presentation.title}
                                            className="h-full w-full rounded object-cover"
                                        />
                                    ) : (
                                        <div className="flex h-full items-center justify-center text-2xl">
                                            🎨
                                        </div>
                                    )}
                                </div>
                                <h3 className="font-medium text-gray-900 group-hover:text-blue-600 dark:text-white">
                                    {presentation.title}
                                </h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    {presentation.total_slides} slides • {presentation.user_name}
                                </p>
                                <p className="text-xs text-gray-500 dark:text-gray-500">
                                    {presentation.created_at}
                                </p>
                            </Link>
                        ))}
                    </div>
                    
                    {presentations.length === 0 && (
                        <div className="py-8 text-center text-gray-500 dark:text-gray-400">
                            <div className="text-4xl">📊</div>
                            <p className="mt-2">No presentations uploaded yet</p>
                            <Link
                                href={route('presentations.create')}
                                className="mt-2 inline-block text-blue-600 hover:text-blue-800 dark:text-blue-400"
                            >
                                Upload your first presentation →
                            </Link>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}