import AppLayout from '@/components/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Presentation {
    id: number;
    title: string;
    filename: string;
    total_slides: number;
    status: string;
    thumbnail_path?: string;
    user: {
        name: string;
    };
    created_at: string;
}

interface Props {
    presentations: {
        data: Presentation[];
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
    filters: {
        search?: string;
        status?: string;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Presentations', href: '/presentations' },
];

const statusColors = {
    uploading: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
    processing: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
    ready: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
    error: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
};

const statusEmojis = {
    uploading: '⏳',
    processing: '🔄',
    ready: '✅',
    error: '❌',
};

export default function PresentationsIndex({ presentations, filters }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Presentations" />
            
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        🎨 Presentations
                    </h1>
                    <Link
                        href={route('presentations.create')}
                        className="inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700"
                    >
                        📤 Upload Presentation
                    </Link>
                </div>

                {/* Filters */}
                <div className="flex gap-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800">
                    <input
                        type="text"
                        placeholder="🔍 Search presentations..."
                        defaultValue={filters.search || ''}
                        className="flex-1 rounded-lg border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    />
                    <select
                        defaultValue={filters.status || ''}
                        className="rounded-lg border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    >
                        <option value="">All Status</option>
                        <option value="ready">Ready</option>
                        <option value="processing">Processing</option>
                        <option value="uploading">Uploading</option>
                        <option value="error">Error</option>
                    </select>
                </div>

                {/* Presentations Grid */}
                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    {presentations.data.map((presentation) => (
                        <div
                            key={presentation.id}
                            className="rounded-lg bg-white p-6 shadow transition-all hover:shadow-lg dark:bg-gray-800"
                        >
                            {/* Thumbnail */}
                            <div className="mb-4 aspect-video rounded-lg bg-gray-100 dark:bg-gray-700">
                                {presentation.thumbnail_path ? (
                                    <img
                                        src={presentation.thumbnail_path}
                                        alt={presentation.title}
                                        className="h-full w-full rounded-lg object-cover"
                                    />
                                ) : (
                                    <div className="flex h-full items-center justify-center text-4xl">
                                        🎨
                                    </div>
                                )}
                            </div>

                            {/* Title and Status */}
                            <div className="mb-2 flex items-start justify-between">
                                <h3 className="flex-1 text-lg font-semibold text-gray-900 dark:text-white">
                                    {presentation.title}
                                </h3>
                                <span
                                    className={`ml-2 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${
                                        statusColors[presentation.status as keyof typeof statusColors]
                                    }`}
                                >
                                    {statusEmojis[presentation.status as keyof typeof statusEmojis]} {presentation.status}
                                </span>
                            </div>

                            {/* Details */}
                            <div className="mb-4 space-y-1 text-sm text-gray-600 dark:text-gray-400">
                                <p>📄 {presentation.filename}</p>
                                <p>📊 {presentation.total_slides} slides</p>
                                <p>👤 {presentation.user.name}</p>
                                <p>📅 {new Date(presentation.created_at).toLocaleDateString()}</p>
                            </div>

                            {/* Actions */}
                            <div className="flex gap-2">
                                <Link
                                    href={route('presentations.show', presentation.id)}
                                    className="flex-1 rounded-lg bg-blue-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-700"
                                >
                                    👁️ View
                                </Link>
                                {presentation.status === 'ready' && (
                                    <button className="rounded-lg bg-green-600 px-3 py-2 text-sm font-medium text-white hover:bg-green-700">
                                        ▶️
                                    </button>
                                )}
                            </div>
                        </div>
                    ))}
                </div>

                {presentations.data.length === 0 && (
                    <div className="py-12 text-center">
                        <div className="text-6xl">🎨</div>
                        <h3 className="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                            No presentations found
                        </h3>
                        <p className="mt-2 text-gray-600 dark:text-gray-400">
                            Upload PowerPoint files to convert them into interactive slides.
                        </p>
                        <Link
                            href={route('presentations.create')}
                            className="mt-6 inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700"
                        >
                            📤 Upload Presentation
                        </Link>
                    </div>
                )}

                {/* Pagination */}
                {presentations.meta.last_page > 1 && (
                    <div className="flex justify-center">
                        <nav className="flex items-center space-x-1">
                            {presentations.links.map((link, index) => (
                                <Link
                                    key={index}
                                    href={link.url || '#'}
                                    className={`px-3 py-2 text-sm ${
                                        link.active
                                            ? 'bg-green-600 text-white'
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