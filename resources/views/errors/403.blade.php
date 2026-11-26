<x-error-page code="403" title="You can't open this page">
    {{ $exception->getMessage() ?: 'You do not have access to this page.' }}
</x-error-page>
