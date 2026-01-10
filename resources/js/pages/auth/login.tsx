import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';

import patient from '@/routes/patient';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/react';

interface LoginProps {
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}

export default function Login({
    status,
    canResetPassword,
    canRegister,
}: LoginProps) {
    return (
        <AuthLayout
            title="Masuk ke Akun Anda"
            description="Masukkan NIK dan Nama Lengkap untuk masuk"
        >
            <Head title="Masuk" />

            <Form
                {...patient.login.form()}
                // resetOnSuccess={['password']}
                className="flex flex-col gap-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-6">
                            <div className="grid gap-2">
                                <Label htmlFor="nik">NIK (Nomor Induk Kependudukan)</Label>
                                <Input
                                    id="nik"
                                    type="text"
                                    inputMode="numeric"
                                    maxLength={16}
                                    name="nik"
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="off"
                                    placeholder="16 digit angka"
                                    onChange={(e) => {
                                        const value = e.target.value.replace(/\D/g, '');
                                        e.target.value = value.slice(0, 16);
                                    }}
                                />
                                <InputError message={errors.nik} />
                            </div>

                            <div className="grid gap-2">
                                <div className="flex items-center">
                                    <Label htmlFor="nama">Nama Lengkap</Label>
                                </div>
                                <Input
                                    id="nama"
                                    type="text"
                                    name="nama"
                                    required
                                    tabIndex={2}
                                    autoComplete="name"
                                    placeholder="Sesuai KTP"
                                />
                                <InputError message={errors.nama} />
                            </div>

                            <div className="flex items-center space-x-3">
                                <Checkbox
                                    id="remember"
                                    name="remember"
                                    tabIndex={3}
                                />
                                <Label htmlFor="remember">Ingat Saya</Label>
                            </div>

                            <Button
                                type="submit"
                                className="mt-4 w-full"
                                tabIndex={4}
                                disabled={processing}
                                data-test="login-button"
                            >
                                {processing && <Spinner />}
                                Masuk
                            </Button>
                        </div>

                        {canRegister && (
                            <div className="text-center text-sm text-muted-foreground">
                                Belum punya akun?{' '}
                                <TextLink href={patient.register.url()} tabIndex={5}>
                                    Daftar sekarang
                                </TextLink>
                            </div>
                        )}
                    </>
                )}
            </Form>

            {status && (
                <div className="mb-4 text-center text-sm font-medium text-green-600">
                    {status}
                </div>
            )}
        </AuthLayout>
    );
}
