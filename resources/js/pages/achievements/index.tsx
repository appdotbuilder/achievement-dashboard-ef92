import AppLayout from '@/components/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Achievement {
    id: number;
    title: string;
    description: string;
    value: number;
    target_value?: number;
    unit?: string;
    category?: string;
    color?: string;
    date: string;
    percentage?: number;
}

interface Props {
    achievements: {
        data: Achievement[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        meta: {
            current_page: number;
            last_page: number;
            per_page: number;
            total: number;
        };
    };
    categories: string[];
    filters: {
        search?: string;
        category?: string;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Achievements', href: '/achievements' },
];

export default function AchievementsIndex({ achievements, categories, filters }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Achievements" />
            
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        📈 Achievements
                    </h1>
                    <Link
                        href={route('achievements.create')}
                        className="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
                    >
                        ➕ New Achievement
                    </Link>
                </div>

                {/* Filters */}
                <div className="flex gap-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800">
                    <input
                        type="text"
                        placeholder="🔍 Search achievements..."
                        defaultValue={filters.search || ''}
                        className="flex-1 rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    />
                    <select
                        defaultValue={filters.category || ''}
                        className="rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    >
                        <option value="">All Categories</option>
                        {categories.map((category) => (
                            <option key={category} value={category}>
                                {category}
                            </option>
                        ))}
                    </select>
                </div>

                {/* Achievements Grid */}
                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    {achievements.data.map((achievement) => (
                        <Link
                            key={achievement.id}
                            href={route('achievements.show', achievement.id)}
                            className="group rounded-lg bg-white p-6 shadow transition-all hover:shadow-lg dark:bg-gray-800"
                        >
                            <div className="mb-4 flex items-start justify-between">
                                <div>
                                    <h3 className="text-lg font-semibold text-gray-900 group-hover:text-blue-600 dark:text-white">
                                        {achievement.title}
                                    </h3>
                                    {achievement.category && (
                                        <span className="inline-block rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                            {achievement.category}
                                        </span>
                                    )}
                                </div>
                                <div
                                    className="h-4 w-4 rounded-full"
                                    style={{ backgroundColor: achievement.color || '#3B82F6' }}
                                />
                            </div>

                            <div className="mb-4">
                                <div className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {achievement.value.toLocaleString()}{achievement.unit}
                                </div>
                                {achievement.target_value && (
                                    <div className="text-sm text-gray-600 dark:text-gray-400">
                                        Target: {achievement.target_value.toLocaleString()}{achievement.unit}
                                    </div>
                                )}
                            </div>

                            {achievement.percentage && (
                                <div className="mb-4">
                                    <div className="flex items-center justify-between text-sm">
                                        <span className="text-gray-600 dark:text-gray-400">Progress</span>
                                        <span className="font-medium text-gray-900 dark:text-white">
                                            {achievement.percentage}%
                                        </span>
                                    </div>
                                    <div className="mt-1 h-2 rounded-full bg-gray-200 dark:bg-gray-700">
                                        <div
                                            className="h-2 rounded-full bg-blue-600"
                                            style={{ width: `${Math.min(achievement.percentage, 100)}%` }}
                                        />
                                    </div>
                                </div>
                            )}

                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                {achievement.description}
                            </p>
                            
                            <div className="mt-4 text-xs text-gray-500 dark:text-gray-500">
                                {new Date(achievement.date).toLocaleDateString()}
                            </div>
                        </Link>
                    ))}
                </div>

                {achievements.data.length === 0 && (
                    <div className="py-12 text-center">
                        <div className="text-6xl">📈</div>
                        <h3 className="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                            No achievements found
                        </h3>
                        <p className="mt-2 text-gray-600 dark:text-gray-400">
                            Start tracking your progress by creating your first achievement.
                        </p>
                        <Link
                            href={route('achievements.create')}
                            className="mt-6 inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
                        >
                            ➕ Create Achievement
                        </Link>
                    </div>
                )}

                {/* Pagination */}
                {achievements.meta.last_page > 1 && (
                    <div className="flex justify-center">
                        <nav className="flex items-center space-x-1">
                            {achievements.links.map((link, index) => (
                                <Link
                                    key={index}
                                    href={link.url || '#'}
                                    className={`px-3 py-2 text-sm ${
                                        link.active
                                            ? 'bg-blue-600 text-white'
                                            : 'text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700'
                                    } ${!link.url ? 'opacity-50 cursor-not-allowed' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </nav>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}