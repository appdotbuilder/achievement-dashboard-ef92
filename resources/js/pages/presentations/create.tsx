import React, { useState } from 'react';
import AppLayout from '@/components/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';





const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Presentations', href: '/presentations' },
    { title: 'Upload', href: '/presentations/create' },
];

export default function CreatePresentation() {
    const { data, setData, post, processing, errors } = useForm({
        title: '',
        presentation: null as File | null,
    });

    const [isDragOver, setIsDragOver] = useState(false);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('presentations.store'));
    };

    const handleFileSelect = (file: File) => {
        setData('presentation', file);
        if (!data.title) {
            // Auto-generate title from filename
            const name = file.name.replace(/\.[^/.]+$/, "");
            setData('title', name);
        }
    };

    const handleDragOver = (e: React.DragEvent) => {
        e.preventDefault();
        setIsDragOver(true);
    };

    const handleDragLeave = (e: React.DragEvent) => {
        e.preventDefault();
        setIsDragOver(false);
    };

    const handleDrop = (e: React.DragEvent) => {
        e.preventDefault();
        setIsDragOver(false);
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.type.includes('presentation') || file.name.endsWith('.pptx') || file.name.endsWith('.ppt')) {
                handleFileSelect(file);
            }
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Upload Presentation" />
            
            <div className="max-w-2xl mx-auto">
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        📤 Upload Presentation
                    </h1>
                    <p className="mt-2 text-gray-600 dark:text-gray-400">
                        Upload PowerPoint files to convert them into interactive slides for your dashboard.
                    </p>
                </div>

                <div className="rounded-lg bg-white p-8 shadow dark:bg-gray-800">
                    <form onSubmit={handleSubmit} className="space-y-6">
                        {/* File Upload Area */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                📎 Presentation File
                            </label>
                            <div
                                className={`mt-2 flex justify-center rounded-lg border-2 border-dashed px-6 py-10 transition-colors ${
                                    isDragOver
                                        ? 'border-green-400 bg-green-50 dark:border-green-500 dark:bg-green-900/20'
                                        : 'border-gray-300 dark:border-gray-600'
                                }`}
                                onDragOver={handleDragOver}
                                onDragLeave={handleDragLeave}
                                onDrop={handleDrop}
                            >
                                <div className="text-center">
                                    <div className="text-4xl mb-4">
                                        {data.presentation ? '📄' : '📤'}
                                    </div>
                                    {data.presentation ? (
                                        <div>
                                            <p className="text-lg font-medium text-gray-900 dark:text-white">
                                                {data.presentation.name}
                                            </p>
                                            <p className="text-sm text-gray-500 dark:text-gray-400">
                                                {(data.presentation.size / 1024 / 1024).toFixed(2)} MB
                                            </p>
                                            <button
                                                type="button"
                                                onClick={() => setData('presentation', null)}
                                                className="mt-2 text-sm text-red-600 hover:text-red-800 dark:text-red-400"
                                            >
                                                ❌ Remove file
                                            </button>
                                        </div>
                                    ) : (
                                        <div>
                                            <p className="text-lg text-gray-600 dark:text-gray-400">
                                                <span className="font-semibold">Click to upload</span> or drag and drop
                                            </p>
                                            <p className="text-sm text-gray-500 dark:text-gray-500">
                                                PowerPoint files (.ppt, .pptx) up to 50MB
                                            </p>
                                        </div>
                                    )}
                                    <input
                                        type="file"
                                        accept=".ppt,.pptx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation"
                                        onChange={(e) => {
                                            const file = e.target.files?.[0];
                                            if (file) handleFileSelect(file);
                                        }}
                                        className="sr-only"
                                        id="file-upload"
                                    />
                                    {!data.presentation && (
                                        <label
                                            htmlFor="file-upload"
                                            className="mt-4 inline-flex cursor-pointer items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700"
                                        >
                                            📁 Choose File
                                        </label>
                                    )}
                                </div>
                            </div>
                            {errors.presentation && (
                                <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                    {errors.presentation}
                                </p>
                            )}
                        </div>

                        {/* Title Field */}
                        <div>
                            <label htmlFor="title" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                📝 Presentation Title
                            </label>
                            <input
                                type="text"
                                id="title"
                                value={data.title}
                                onChange={(e) => setData('title', e.target.value)}
                                className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                placeholder="Enter a title for your presentation"
                            />
                            {errors.title && (
                                <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                    {errors.title}
                                </p>
                            )}
                        </div>

                        {/* Submit Button */}
                        <div className="flex items-center justify-between pt-6">
                            <button
                                type="button"
                                onClick={() => router.get(route('presentations.index'))}
                                className="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                            >
                                ← Back to Presentations
                            </button>
                            <button
                                type="submit"
                                disabled={processing || !data.presentation}
                                className="inline-flex items-center rounded-lg bg-green-600 px-6 py-2 text-sm font-medium text-white hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                {processing ? (
                                    <>
                                        <div className="mr-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent" />
                                        Uploading...
                                    </>
                                ) : (
                                    <>📤 Upload Presentation</>
                                )}
                            </button>
                        </div>
                    </form>
                </div>

                {/* Info Box */}
                <div className="mt-6 rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
                    <div className="flex">
                        <div className="text-2xl mr-3">💡</div>
                        <div>
                            <h3 className="text-sm font-medium text-blue-800 dark:text-blue-200">
                                How it works
                            </h3>
                            <div className="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                <ul className="list-disc list-inside space-y-1">
                                    <li>Upload PowerPoint (.ppt/.pptx) files up to 50MB</li>
                                    <li>Files are automatically processed and converted to slides</li>
                                    <li>View presentations as interactive slide shows in your dashboard</li>
                                    <li>Share presentations with team members</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}