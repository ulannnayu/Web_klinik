import patient from '@/routes/patient';
import { Form, Head } from '@inertiajs/react';

import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';

export default function Register() {
    return (
        <AuthLayout
            title="Pendaftaran Pasien"
            description="Silakan isi data diri Anda untuk mendaftar"
        >
            <Head title="Daftar Akun" />
            <Form
                {...patient.register.submit.form()}
                // resetOnSuccess={['password', 'password_confirmation']} // Removed as we don't use passwords anymore
                disableWhileProcessing
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
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="off"
                                    name="nik"
                                    placeholder="16 digit angka"
                                    onChange={(e) => {
                                        // Only allow numeric input
                                        const value = e.target.value.replace(/\D/g, '');
                                        e.target.value = value.slice(0, 16);
                                    }}
                                />
                                <InputError message={errors.nik} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="nama">Nama Lengkap</Label>
                                <Input
                                    id="nama"
                                    type="text"
                                    required
                                    tabIndex={2}
                                    autoComplete="name"
                                    name="nama"
                                    placeholder="Sesuai KTP"
                                />
                                <InputError message={errors.nama} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="tgl_lahir">Tanggal Lahir</Label>
                                <Input
                                    id="tgl_lahir"
                                    type="date"
                                    required
                                    tabIndex={3}
                                    name="tgl_lahir"
                                />
                                <InputError message={errors.tgl_lahir} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="alamat">Alamat Lengkap</Label>
                                <Input
                                    id="alamat"
                                    type="text" // Using Input instead of textarea for consistency with UI components, or could be a Textarea if available
                                    required
                                    tabIndex={4}
                                    autoComplete="street-address"
                                    name="alamat"
                                    placeholder="Jalan, RT/RW, Dusun, Desa, Kecamatan..."
                                />
                                <InputError message={errors.alamat} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="no_bpjs">No. BPJS (Opsional)</Label>
                                <Input
                                    id="no_bpjs"
                                    type="text"
                                    inputMode="numeric"
                                    tabIndex={5}
                                    name="no_bpjs"
                                    placeholder="Jika ada"
                                />
                                <InputError message={errors.no_bpjs} />
                            </div>

                            <Button
                                type="submit"
                                className="mt-2 w-full"
                                tabIndex={6}
                            >
                                {processing && <Spinner />}
                                Daftar Sekarang
                            </Button>
                        </div>

                        <div className="text-center text-sm text-muted-foreground">
                            Sudah punya akun?{' '}
                            <TextLink href={patient.login().url} tabIndex={7}>
                                Masuk disini
                            </TextLink>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}
